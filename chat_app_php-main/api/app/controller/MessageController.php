<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
class MessageController{
    private Config $conn;

    public function __construct()
    {
        if(!isset($_SESSION)){
            session_start();
        }
        $this->conn = new Config();
    }

    public function insertChat(){
        $outgoing_id = $_SESSION['tendangnhap'];
        $incoming_id = mysqli_real_escape_string($this->conn->connect(), $_POST['incoming_id']);
        $message = mysqli_real_escape_string($this->conn->connect(), $_POST['message']);
        $date = date("Y/m/d G:i:s", time());
        if(!empty($message)){
            $sql = "INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`, `Time`, `CheDo`) 
            VALUES (NULL, '$incoming_id', '$outgoing_id', '$message', '$date', '0');";
            mysqli_query($this->conn->connect(), $sql) or die();
        }
    }

    public function updateChat($incoming_id){
        $outgoing_id = $_SESSION['tendangnhap'];
            $sql = "UPDATE `messages` SET `CheDo` = '1' 
            WHERE (outgoing_msg_id = '{$outgoing_id}' AND incoming_msg_id = '{$incoming_id}')
            OR (outgoing_msg_id = '{$incoming_id}' AND incoming_msg_id = '{$outgoing_id}')";
            mysqli_query($this->conn->connect(), $sql) or die();
    }

    public function getChat(){
        $outgoing_id = $_SESSION['tendangnhap'];
        $incoming_id = mysqli_real_escape_string($this->conn->connect(), $_POST['incoming_id']);
        $output = "";
        $ngay = "";
        $sql = "SELECT * FROM messages 
        LEFT JOIN hocsinh ON hocsinh.TenDN = messages.outgoing_msg_id
        WHERE (outgoing_msg_id = '{$outgoing_id}' AND incoming_msg_id = '{$incoming_id}')
        OR (outgoing_msg_id = '{$incoming_id}' AND incoming_msg_id = '{$outgoing_id}') ORDER BY msg_id";
        $query = mysqli_query($this->conn->connect(), $sql);
        if(mysqli_num_rows($query)>0){
            while ($row = mysqli_fetch_assoc($query)){
                $gio = date("G:i", strtotime($row["Time"]));
                $ngaycu = $ngay;
                $ngay = date("d/m", strtotime($row["Time"]));
                if($row['outgoing_msg_id'] === $outgoing_id){
                    $output .= '<div class="chat outgoing">';
                    $output .= '<div class="details"> 
                                  '.$ngay." ".$gio.'
                                    <p>'.$row['msg'].'</p>
                                  </div>
                                </div>';
                } else {
                    $output .= '<div class="chat incoming">';   
                    $output .= '<div class="details"> 
                                  '.$ngay." ".$gio.'
                                    <p>'.$row['msg'].'</p>
                                  </div>
                                </div>';
                }
            }
        } else {
            $output .= "<div class='text'>Không có tin nhắn. Khi bạn có, tin nhắn sẽ hiện tại đây.</div>";
        }
        echo $output;
    }
}