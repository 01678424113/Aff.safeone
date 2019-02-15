<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use App\Models\Campaign;
use App\Models\UserCampaign;
use Illuminate\Http\Request;

class AffController extends Controller
{
    public function joinCampaign(Request $request, $campaign_id)
    {
        $check = UserCampaign::where('campaign_id', $campaign_id)->first();
        if (!isset($check)) {
            $user_campaign = new UserCampaign();
            $user_campaign->user_id = \Auth::user()->id;
            $user_campaign->campaign_id = $campaign_id;
            try {
                $user_campaign->save();
                return redirect()->back()->with('success', 'Tham gia thành công');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Đã xảy ra lỗi');
            }
        } else {
            return redirect()->back()->with('error', 'Bạn đã tham gia chiến dịch này rồi');
        }
    }

    public function createLinkAFF(Request $request)
    {
        $campaign_id = $request->campaign_id;
        $campaign = Campaign::where('id', $campaign_id)->first();
        if (isset($campaign)) {
            $check = Affiliate::where('user_id', \Auth::user()->id)->where('campaign_id', $campaign_id)->first();
            if (!isset($check)) {
                $aff = new Affiliate();

                do {
                    $aff_id = str_replace('/','',base64_encode(random_bytes(10)) . time());
                    $check = Affiliate::where('aff_id', $aff_id)->first();
                } while (!empty($check));
                $aff->aff_id = $aff_id;
                $aff->user_id = \Auth::user()->id;
                $aff->campaign_id = $campaign_id;
                $aff->created_at = date('Y-m-d H:i:s');
                $aff->save();
                $response['status'] = 1;
                $response['aff_id'] = $aff_id;
                $response['campaign_id'] = $campaign_id;
                return $response;
            } else {
                $response['status'] = 1;
                $response['aff_id'] = $check->aff_id;
                $response['campaign_id'] = $campaign_id;
                return $response;
            }
        }
    }

    public function affRedirectStep1($aff_id)
    {
        $aff = Affiliate::where('aff_id',$aff_id)->first();
        if(isset($aff)){
            $campaign = Campaign::where('id',$aff->campaign_id)->first();
            if(isset($campaign)){
                $link = $campaign->root_url;
                return view('admin.page.redirect-step-1',compact('link'));
            }else{
                echo 'Không tìm thấy chiến dịch';
            }
        }else{
            echo 'Không tìm thấy link AFF';
        }
    }

    public function saveCookie()
    {
        $referer = $_SERVER['HTTP_REFERER'];
        $referer = explode('/',$referer);
        if(isset($referer[2]) && $referer[2] == 'aff.temaz.net'){
            $keys = array_keys($referer);
            $aff_id = $referer[end($keys)];
            $cookie_name = "afftemaz";
            $cookie_value = $aff_id;
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
        }
    }
}
