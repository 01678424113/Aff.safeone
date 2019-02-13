# Admin For Happyness.Work
## List Functions
1. Login/Logout
2. Phân quyền admin (tài khoản sale khác, tài khoản supporter khác, tài khoản admin khác, tài khoản kỹ thuật khác...)
3. Quản lý Menu: Quản lý danh sách menu hiển thị ở cột trái mzg.happyness.work
4. Quản lý danh sách quyền: Bảng permission
5. Quản lý service

6. Quản lý danh sách công ty
    1. Danh sách công ty
    2. Lọc theo các trường
    3. Chi tiết công ty (thông tin cty, tạo bao giờ, gói nào, bao giờ hết hạn)
    4. Thêm mới/sửa cty
    
7. Quản lý giao dịch
    1. Danh sách giao dịch, tổng số tiền
    2. Lọc theo các loại điều kiện
    3. Chi tiết giao dịch
    4. Thêm mới giao dịch (dùng cho trường hợp khách chuyển khoản ngân hàng) - Thông báo về email

8. Quản lý gói sản phẩm (package)
    1. Tạo bảng packages (id, name, description, number_user), thêm trường package_id vào companies
    2. Quản lý danh sách gói
    3. Thêm/sửa/xóa gói
    4. Chi tiết gói (bao nhiêu cty đăng ký gói này, các cty đấy là cty nào)

9. Tool
    1. Cộng tiền vào tài khoản cho khách hàng (thông báo về email)
    2. Trừ tiền trong tài khoản của khách hàng (thông báo về email)
    3. Gia hạn tài khoản cho khách hàng (thông báo về email)
    4. Gia hạn service cho khách hàng (thông báo về email)
    
10. Báo cáo
    1. Hiện các công ty đang chuẩn bị hết hạn (để gọi điện chăm sóc)
    2. Hiện các công ty đang sắp hết hạn service, các service cụ thể
    3. Biểu đồ số lượng công ty đăng ký theo ngày/tuần/tháng/năm
    4. Biểu đồ số lượng giao dịch theo ngày/tuần/tháng/năm
    5. Biểu đồ doanh thu then ngày/tuần/tháng/năm
    
    
## Work Schedule
1. Spin 1: Phân tích yêu cầu
    1. Phân tích kỹ yêu cầu
    2. Trao đổi những phần chưa rõ
    3. Lên kế hoạch làm các đầu việc: đầu việc nào làm trong bao lâu, nhập lên issue
2. Spin 2: Lên giao diện
    1. **Dev** Dựa vào yêu cầu, lên sẵn tất cả giao diện các mục
    2. **Tester** dựa vào giao diện và yêu cầu => Viết testcase
3. Spin 3: Code
    1. **Dev** Code theo yêu cầu + giao diện đã lên + theo kế hoạch đầu việc ở spin 1
    2. **Tester** Test cuốn chiếu, dev xong module nào test luôn module đấy
4. Spin 4: Testing + Fix Bug
    1. **Dev** Fix toàn bộ lỗi mà *Tester* báo
    2. **Tester** ReTest lại các lỗi *Dev* đã fix
    3. Test và fix cho đến khi không còn lỗi
    4. **Dev** Quét bảo mật + fix bảo mật  
## Run ngrok
ngrok http -host-header=rewrite domain_name:80          
