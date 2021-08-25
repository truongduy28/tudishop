<?php
    ob_start();
    require_once ('config.php');
    // function
    function execute($sql){
        $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
        mysqli_query($conn,$sql);
       
        mysqli_close($conn);

    }
    function executeResult($sql){
        $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
        $result = mysqli_query($conn,$sql);
        // $data = [];
        // while ($row = mysqli_fetch_array($result,1)){
        //     $data[] =$row; 
        // }
        // mysqli_close($conn);
        // return $data;
        if(mysqli_errno($conn)){
            // echo 'Cant connect database';
        }
        if($result != null){
            $data = [];
            while ($row = mysqli_fetch_array($result,1)){
                $data[] =$row; 
            }
            mysqli_close($conn);
            return $data;
        }
        else{
            // echo ' Không thấy dữ liệu';  
        }
       
    }