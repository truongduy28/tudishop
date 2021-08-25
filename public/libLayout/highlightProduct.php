<div class="container-product" id="product">
    <h1>SẢN PHẨM NỔI BẬT</h1>
    <div class="product">
        <?php
        $sql = 'SELECT * FROM sanpham ORDER by ngaydang  LIMIT 8';
        $list_sanpham = executeResult($sql);
        if ($list_sanpham != null) {
            foreach ($list_sanpham as $sanpham) {
                echo ' 
                                   <div class="product__element">
                                        <a href="product.php?id=' . $sanpham['id_sanpham'] . '"><img src="' . $sanpham['img'] . '" alt=""></a>
                                        <br>
                                        <h5>' . $sanpham['tensanpham'] . '</h5>
                                        <p>' . number_format($sanpham['gia']) . ' vnđ</p>
                                        <br>
                                        <a href="../../db/addtocard.php?id=' . $sanpham['id_sanpham'] . '" class="addcart" style="color: black"> Thêm vào giỏ</a>
                                        
                                    </div>
                                ';
            }
        }

        ?>

    </div>
    <br>
    <p style="text-align: center; margin: 20px 10px 50px;"> <a style="text-align: center;" href="products.php">Xem thêm tất cả sản phẩm >></a></p>
</div>
