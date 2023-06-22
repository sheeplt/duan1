<?php
class UserController{
    public Config $conn;

    public function __construct()
    {
        if(!isset($_SESSION)){
            session_start();
        }
        $this->conn = new Config();
    }
    public function getUserById($unique_id){
        $sql = mysqli_query($this->conn->connect(), "SELECT * FROM `taikhoan` JOIN hocsinh ON hocsinh.TenDN = taikhoan.TenDN WHERE taikhoan.TenDN = '{$unique_id}'");
        if(mysqli_num_rows($sql)>0){
            return mysqli_fetch_assoc($sql);
        }
    }
    public function getUserByIdGV($unique_id){
        $sql = mysqli_query($this->conn->connect(), "SELECT * FROM `taikhoan` JOIN giaovien ON giaovien.TenDN = taikhoan.TenDN WHERE giaovien.MaGV = '{$unique_id}'");
        if(mysqli_num_rows($sql)>0){
            return mysqli_fetch_assoc($sql);
        }
    }
    public function getUserByIdQL($unique_id){
        $sql = mysqli_query($this->conn->connect(), "SELECT * FROM `taikhoan` JOIN quanli ON quanli.TenDN = taikhoan.TenDN WHERE quanli.MaQL = '{$unique_id}'");
        if(mysqli_num_rows($sql)>0){
            return mysqli_fetch_assoc($sql);
        }
    }

    public function getDatatoQL(){
        $sql = "SELECT * FROM quanli";
        $query = mysqli_query($this->conn->connect(), $sql);
        $output = "";

        if(mysqli_num_rows($query) == 0){
            $output .= "Không có học sinh hoạt động";
        }elseif(mysqli_num_rows($query)>0){
            $output = $this->getFriendListtoQL($query);
        }
        echo $output;
    }
    
    public function getDatatoGV(){
        $sql = "SELECT * FROM giaovien
        JOIN lophoc ON lophoc.MaGV = giaovien.MaGV
        JOIN ctlophoc ON ctlophoc.MaLopHoc = lophoc.MaLopHoc
        WHERE ctlophoc.MaHocSinh = {$_SESSION['unique_id']};";
        $query = mysqli_query($this->conn->connect(), $sql);
        $output = "";

        if(mysqli_num_rows($query) == 0){
            $output .= "Không có giáo vụ hoạt động";
        }elseif(mysqli_num_rows($query)>0){
            $output = $this->getFriendListtoGV($query);
        }
        echo $output;
    }


    public function searchUsertoQL($searchTerm){
        $sql = "SELECT * FROM quanli
        WHERE (TenQL LIKE '%{$searchTerm}%')";
        $output = "";
        $query = mysqli_query($this->conn->connect(), $sql);
        if(mysqli_num_rows($query) > 0){
            $output .= $this->getFriendListtoHS($query);
        }else{
            $output .= "Không tìm thấy người dùng liên quan đến từ khóa";
        }
        echo $output;
    }
    
    public function searchUsertoGV($searchTerm){
        $sql = "SELECT * FROM giaovien 
                WHERE (TenGV LIKE '%{$searchTerm}%')";
        $output = "";
        $query = mysqli_query($this->conn->connect(), $sql);
        if(mysqli_num_rows($query) > 0){
            $output .= $this->getFriendListtoGV($query);
        }else{
            $output .= "Không tìm thấy người dùng liên quan đến từ khóa";
        }
        echo $output;
    }
    
    public function getFriendListtoQL($query): string
    {
        $rs = '';
        while($row = mysqli_fetch_assoc($query)){
            // select one last message
            $sql = "SELECT * FROM messages WHERE 
            (incoming_msg_id = '{$row['TenDN']}' OR outgoing_msg_id = '{$row['TenDN']}') 
        AND (outgoing_msg_id = '{$_SESSION['tendangnhap']}' OR incoming_msg_id = '{$_SESSION['tendangnhap']}')
        ORDER BY msg_id DESC LIMIT 1";
            $query2 = mysqli_query($this->conn->connect(), $sql);
            $data = mysqli_fetch_assoc($query2);

            $last_mess = '';
            if(mysqli_num_rows($query2)>0){
                $chedo = $data['CheDo'];
                $last_mess = $data['msg'];
            }else{
                $last_mess = "Không có tin nhắn";
            }

            if(strlen($last_mess) > 28){
                $chedo = $data['CheDo'];
                $last_mess = substr($last_mess, 0, 28) . '...';
            }

            // if you are the last rep person
            $you = "";
            if(isset($data['outgoing_msg_id'])){
                $chedo = $data['CheDo'];
                ($_SESSION['tendangnhap'] == $data['outgoing_msg_id']) ? $you = "Bạn: " : $you = "";
            }

            // answerer activity
            ($row['status'] == "0") ? $offline = "offline" : $offline = "";

            // content
            $rs .= '<a href="HS.php?hoithoai='.$row['MaQL'].'">
                  <div class="content">
                    <img src="view/images/'.$row['HinhAnh'].'"/>
                    <div class="details">
                      <span>'.$row['TenQL'].' (';
                      
            if($row['Role'] == 1){
                $rs .= 'Giáo vụ chung';
            }else{
                $rs .= 'Giáo vụ tư vấn';
            }
            $rs .= ')'.'</span>
            <div>'.$you ;
            if($chedo == 0 and $you == "" and $last_mess != "Không có tin nhắn"){
                $rs .= '<b>'.$last_mess.'</b>' ;
            }else{   
                $rs .= $last_mess ;
            }
            $rs .=           '</div>
                    </div>
                    
                  </div>
                  <div class="status-dot '.$offline.'"><i class="fas fa-circle"></i></div>
                </a>';
        }
        return $rs;
    }
    public function getFriendListtoGV($query): string
    {
        $rs = '';
        while($row = mysqli_fetch_assoc($query)){
            // select one last message
            $sql = "SELECT * FROM messages WHERE 
            (incoming_msg_id = '{$row['TenDN']}' OR outgoing_msg_id = '{$row['TenDN']}') 
        AND (outgoing_msg_id = '{$_SESSION['tendangnhap']}' OR incoming_msg_id = '{$_SESSION['tendangnhap']}')
        ORDER BY msg_id DESC LIMIT 1";
            $query2 = mysqli_query($this->conn->connect(), $sql);
            $data = mysqli_fetch_assoc($query2);
            $chedo = '';
            $last_mess = '';
            if(mysqli_num_rows($query2)>0){
                $last_mess = $data['msg'];
                $chedo = $data['CheDo'];
            }else{
                $last_mess = "Không có tin nhắn";
            }

            if(strlen($last_mess) > 28){
                $last_mess = substr($last_mess, 0, 28) . '...';
                $chedo = $data['CheDo'];
            }

            // if you are the last rep person
            $you = "";
            if(isset($data['outgoing_msg_id'])){
                ($_SESSION['tendangnhap'] == $data['outgoing_msg_id']) ? $you = "Bạn: " : $you = "";
                $chedo = $data['CheDo'];
            }

            // answerer activity
            ($row['status'] == "0") ? $offline = "offline" : $offline = "";

            // content
            $rs .= '<a href="HS.php?hoithoai='.$row['MaGV'].'">
                  <div class="content">
                    <img src="view/images/'.$row['HinhAnh'].'"/>
                    <div class="details">
                      <span>'.$row['TenGV'].'</span>
                      <div>'.$you ;
            if($chedo == 0 and $you == "" and $last_mess != "Không có tin nhắn"){
                $rs .= '<b>'.$last_mess.'</b>' ;
            }else{   
                $rs .= $last_mess ;
            }
            $rs .=           '</div>
                    </div>
                    
                  </div>
                  <div class="status-dot '.$offline.'"><i class="fas fa-circle"></i></div>
                </a>';
        }
        return $rs;
    }
}