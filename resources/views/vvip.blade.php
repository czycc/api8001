<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="../res/vvip/js/flexible.js"></script>
    <link rel="stylesheet" href="../res/vvip/css/reset.css">
    <link rel="stylesheet" href="../res/vvip/css/swiper.css">
    <link rel="stylesheet" href="../res/vvip/css/index.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--<link rel="stylesheet" href="../res/vvip/css/style.css">-->
    <title>渣打银行</title>
</head>
<body>
<div class="swiper-container">
    <div class="swiper-wrapper">
        <section class="page1 swiper-slide">
            <img class='header' src="../res/vvip/images/header.png"/>
            <p class='text1'>2018</p>
            <p class='text2'>优先理财客户礼品兑换平台</p>
            <p class='text1'>开启</p>
            <p class='text2'>美好生活旅程</p>
        </section>

        <section class="page2 swiper-slide">
            <img class='header' src="../res/vvip/images/header.png"/>
            <h3>公告信息</h3>
            <div class="info">
                <!-- 公告内容 -->
                {!! $news->news !!}
            </div>
            <span class="rules">条款与细则</span>
            <img class="next" src="../res/vvip/images/next.png">
        </section>

        <section class="page3 swiper-slide">
            <img class='header' src="../res/vvip/images/header.png"/>
            <p id="page3_tips">请输入您的礼品兑换码</p>
            <input type="text"><br/>
            <img class="confrim" src="../res/vvip/images/confrim.png">
            <span class="rules">条款与细则</span>
            <img class="next" src="../res/vvip/images/next.png">
        </section>
    </div>
</div>
<section class="gift_select hidden">
    <ul>
        <li>
            @if($stock->gift1 > 0)
            <span class="">库存正常</span>
            @else
                <span class="hidden">库存正常</span>
                <span style="color:red">库存缺货</span>
            @endif
            <img src="../res/vvip/images/gift1.png" alt="">
        </li>
        <li>
            @if($stock->gift2 > 0)
                <span class="">库存正常</span>
            @else
                <span class="hidden">库存正常</span>
                <span style="color:red">库存缺货</span>
            @endif
            <img src="../res/vvip/images/gift2.png" alt="">
        </li>
        <li>
            @if($stock->gift3 > 0)
                <span class="">库存正常</span>
            @else
                <span class="hidden">库存正常</span>
                <span style="color:red">库存缺货</span>
            @endif
            <img src="../res/vvip/images/gift3.png" alt="">
        </li>
    </ul>
    <span class="rules">条款与细则</span>
    <img class="next" src="../res/vvip/images/next.png">
</section>
<section class="gift_select2 hidden">
    <ul>
        <li>
            @if($stock->gift4 > 0)
                <span class="">库存正常</span>
            @else
                <span class="hidden">库存正常</span>
                <span style="color:red">库存缺货</span>
            @endif
            <img src="../res/vvip/images/gift4.png" alt="">
        </li>
        <li>
            @if($stock->gift5 > 0)
                <span class="">库存正常</span>
            @else
                <span class="hidden">库存正常</span>
                <span style="color:red">库存缺货</span>
            @endif
            <img src="../res/vvip/images/gift5.png" alt="">
        </li>
        <li>
            @if($stock->gift6 > 0)
                <span class="">库存正常</span>
            @else
                <span class="hidden">库存正常</span>
                <span style="color:red">库存缺货</span>
            @endif
            <img src="../res/vvip/images/gift6.png" alt="">
        </li>
        <!-- <li>
            @if($stock->gift7 > 0)
                <span class="">库存正常</span>
            @else
                <span class="hidden">库存正常</span>
                <span style="color:red">库存缺货</span>
            @endif
            <img src="../res/vvip/images/gift7.png" alt="">
        </li> -->
    </ul>
    <span class="rules">条款与细则</span>
    <img class="next" src="../res/vvip/images/next.png">
</section>
<section class="gift_select3 hidden">
    <ul>
        <li>
            @if($stock->gift8 > 0)
                <span class="">库存正常</span>
            @else
                <span class="hidden">库存正常</span>
                <span style="color:red">库存缺货</span>
            @endif
            <img src="../res/vvip/images/gift8.png" alt="">
        </li>
        <li>
            @if($stock->gift9 > 0)
                <span class="">库存正常</span>
            @else
                <span class="hidden">库存正常</span>
                <span style="color:red">库存缺货</span>
            @endif
            <img src="../res/vvip/images/gift9.png" alt="">
        </li>
        <li>
            @if($stock->gift10 > 0)
                <span class="">库存正常</span>
            @else
                <span class="hidden">库存正常</span>
                <span style="color:red">库存缺货</span>
            @endif
            <img src="../res/vvip/images/gift10.png" alt="">
        </li>
    </ul>
    <span class="rules">条款与细则</span>
    <img class="next" src="../res/vvip/images/next.png">
</section>
<section class="gift_select4 hidden">
    <ul>
        <li>
            @if($stock->gift11 > 0)
                <span class="">库存正常</span>
            @else
                <span class="hidden">库存正常</span>
                <span style="color:red">库存缺货</span>
            @endif
            <img src="../res/vvip/images/gift11.png" alt="">
        </li>
        <li>
            @if($stock->gift12 > 0)
                <span class="">库存正常</span>
            @else
                <span class="hidden">库存正常</span>
                <span style="color:red">库存缺货</span>
            @endif
            <img src="../res/vvip/images/gift12.png" alt="">
        </li>
        <li>
            @if($stock->gift13 > 0)
                <span class="">库存正常</span>
            @else
                <span class="hidden">库存正常</span>
                <span style="color:red">库存缺货</span>
            @endif
            <img src="../res/vvip/images/gift13.png" alt="">
        </li>
    </ul>
    <span class="rules">条款与细则</span>
    <img class="next" src="../res/vvip/images/next.png">
</section>
<section class="gift_select5 hidden">
		<ul>
			<li>
            @if($stock->gift15 > 0)
                <span class="">库存正常</span>
            @else
                <span class="hidden">库存正常</span>
                <span style="color:red">库存缺货</span>
            @endif
				<img src="../res/vvip/images/gift15.png">
			</li>
			<li>
            @if($stock->gift16 > 0)
                <span class="">库存正常</span>
            @else
                <span class="hidden">库存正常</span>
                <span style="color:red">库存缺货</span>
            @endif
				<img src="../res/vvip/images/gift16.png">
			</li>
		</ul>
		<span class="rules">条款与细则</span>
		<img class="next" src="../res/vvip/images/next.png">
	</section>
	<section class="gift_select6 hidden">
		<ul>
			<li>
            @if($stock->gift17 > 0)
                <span class="">库存正常</span>
            @else
                <span class="hidden">库存正常</span>
                <span style="color:red">库存缺货</span>
            @endif
				<img src="../res/vvip/images/gift17.png" alt="">
			</li>
			<li>
            @if($stock->gift18 > 0)
                <span class="">库存正常</span>
            @else
                <span class="hidden">库存正常</span>
                <span style="color:red">库存缺货</span>
            @endif
				<img src="../res/vvip/images/gift18.png" alt="">
			</li>
			<li>
            @if($stock->gift19 > 0)
                <span class="">库存正常</span>
            @else
                <span class="hidden">库存正常</span>
                <span style="color:red">库存缺货</span>
            @endif
				<img src="../res/vvip/images/gift19.png" alt="">
			</li>
		</ul>
		<span class="rules">条款与细则</span>
		<img class="next" src="res/images/next.png">
	</section>
<section class="gift hidden">
    <img id="gift_photo" src="" alt="">
    <div id="gift_title">

    </div>
    <div id="gift_info">
        <div class="infoText">

        </div>
    </div>
    <div class="gift_btn">
        <img src="../res/vvip/images/btn_return.png" alt="" class="btn_return">
        <img src="../res/vvip/images/btn_comfirm.png" alt="" class="btn_comfirm">
    </div>
    <span class="rules">条款与细则</span>
    <img class="next" src="../res/vvip/images/next.png">
</section>
<section class="orderForm hidden">
    <form action="">
        <p class="title">订单信息</p>
        <div class="username">
            <span>姓名:</span>
            <input type="text" class="name">
        </div>
        <div class="phoneNum">
            <span>联系方式:</span>
            <input type="text" class="phone">
        </div>
        <div class="browser">
            <!--选择地区-->
            <div class="express-area">
                <span></span>
                <a id="expressArea" href="javascript:void(0)">
                    市/省份
                    <p class="proText"></p>
                </a>
            </div>
            <!--选择地区弹层-->
            <div id="areaLayer" class="express-area-box">
                <header>
                    <h3>选择地区</h3>
                    <a id="backUp" class="back" href="javascript:void(0)" title="返回"></a>
                    <a id="closeArea" class="close" href="javascript:void(0)" title="关闭"></a>
                </header>
                <article id="areaBox">
                    <ul id="areaList" class="area-list"></ul>
                </article>
            </div>
            <!--遮罩层-->
            <div id="areaMask" class="mask"></div>
        </div>
        <div class="district">
            <span>区/县</span>
            <div class="districtText"></div>
        </div>
        <div class="postcode">
            <span>邮编:</span>
            <input type="text" class="code">
        </div>
        <div class="detailed">
            <span>详细收货地址:</span>
            <textarea name="" id="" cols="30" rows="10" class="detailedText"></textarea>
        </div>
        <div class="remarks">
            <input type="text" placeholder="备注留言(富士相机选色)">
        </div>
        <label for="">
            <!--<input id="submit" type="submit" style="display: none">-->
            <img class="btn_submit" src="../res/vvip/images/btn_submit.png" alt="">
        </label>

    </form>
    <span class="rules">条款与细则</span>
    <img class="next" src="../res/vvip/images/next.png">
</section>
<!-- <section class="identityInfo hidden">
    <form action="">
        <p class="title">订单信息</p>
        <input type="text" class="identityNun" placeholder="身份证号码">
        <div class="identityPhoto">
            <span>上传身份证照片</span>
            <label for="file_input">
                <img src="../res/vvip/images/icon_photo.png" alt="">
                <input name="photo" style="display: none" id="file_input" type="file" accept="image/*"/>
            </label>
        </div>

    </form>
    <div class="picture_iden">
        <img class="upload_img" src="" alt="">
    </div>
    <img src="../res/vvip/images/btn_submit.png" alt="" class="btn_identityInfo">
    <span class="rules">条款与细则</span>
</section> -->
<section class="info info1 hidden">
    <div class="info_content">
        <div>
            <span class="info-ti">姓名</span>
            <span class="username"></span>
        </div>
        <div>
            <span class="info-ti">联系方式</span>
            <span class="phone"></span>
        </div>
        <div>
            <span class="info-ti">邮编</span>
            <span class="code"></span>
        </div>
        <div class="info_location">
            <span class="info-ti">详细收货地址</span>
            <span class="site"></span>
        </div>
        <div class="info_remarks hidden">
            <span>备注</span>
            <span class="remarks"></span>
        </div>
    </div>
    <div class="btn">
        <span class="btn_modify">修改</span>
        <span class="btn_infoComfirm">确认</span>
    </div>
    <!-- <div class="popup">
        上传中。。。。
    </div> -->
</section>
<section class="info info2 hidden">
    <div class="info_content" id="info_content">
        <div>
            <span class="info-ti">订单号码</span>
            <span class="orderCode"></span>
        </div>
        <div>
            <span class="info-ti">姓名</span>
            <span class="username"></span>
        </div>
        <div>
            <span class="info-ti">联系方式</span>
            <span class="phone"></span>
        </div>
        <div>
            <span class="info-ti">邮编</span>
            <span class="code"></span>
        </div>
        <div class="info_location">
            <span class="info-ti">详细收货地址</span>
            <span class="site"></span>
        </div>
        <div class="info_remarks hidden">
            <span>备注</span>
            <span class="remarks"></span>
        </div>
    </div>
    <div class="infoImg">
    </div>
    <div class="btn">
        <span>长按保存图片</span>
    </div>
</section>
<div class="hint hidden">
    长按图片，保存到手机
</div>
</body>
<script src="../res/vvip/js/jquery.js"></script>
<script type="application/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script src="../res/vvip/js/swiper.min.js"></script>
<script src="../res/vvip/js/mobile/layer.js"></script>
<script src="../res/vvip/js/jquery.area.js"></script>
<script src="../res/vvip/js/html2canvas.js"></script>
<script src="../res/vvip/js/index.js"></script>
</html>
