@extends('master')

@section('title', '订单提交')

@section('content')
  <div class="page bk_content" style="top: 0;">
    <div class="weui_cells">
        @foreach($cart_items as $cart_item)
        <div class="weui_cell">
            <div class="weui_cell_hd">
              <img src="./{{$cart_item->book->preview}}" alt="" class="bk_icon">
            </div>
            <div class="weui_cell_bd weui_cell_primary">
                <p class="bk_summary">{{$cart_item->book->title}}</p>
            </div>
            <div class="weui_cell_ft">
              <span class="bk_price">{{$cart_item->book->price}}</span>
              <span> x </span>
              <span class="bk_important">{{$cart_item->count}}</span>
            </div>
        </div>
        @endforeach
    </div>
    <div class="weui_cells_title">支付方式</div>
    <div class="weui_cells">
        <div class="weui_cell weui_cell_select">
            <div class="weui_cell_bd weui_cell_primary">
                <select class="weui_select" name="payway">
                    <option selected="" value="1">支付宝</option>
                    <option value="2">微信</option>
                </select>
            </div>
        </div>
    </div>

    <form action="./service/alipay" id="alipay" method="post">
      {{ csrf_field() }}
      <input type="hidden" name="total_price" value="{{$total_price}}" />
      <input type="hidden" name="name" value="{{$name}}" />
      <input type="hidden" name="order_no" value="{{$order_no}}" />
    </form>

    <div class="weui_cells">
        <div class="weui_cell">
            <div class="weui_cell_bd weui_cell_primary">
                <p>总计:</p>
            </div>
            <div class="weui_cell_ft bk_price" style="font-size: 25px;">￥ {{$total_price}}</div>
        </div>
    </div>
  </div>
  <div class="bk_fix_bottom">
    <div class="bk_btn_area">
      <button class="weui_btn weui_btn_primary" onclick="_onPay();">支付订单</button>
    </div>
  </div>

@endsection

@section('my-js')

<script type="text/javascript">
function _onPay() {
    var payway = $('.weui_select option:selected').val();
    if(payway == '1') {
      $('#alipay').submit();
      return;
    }
    $.ajax({
      type: "POST",
      url: './service/wxpay',
      dataType: 'json',
      cache: false,
      data: {name: "{{$name}}", order_no: "{{$order_no}}", total_price: "{{$total_price}}", _token: "{{csrf_token()}}"},
      success: function(data) {
        if(data == null) {
          $('.bk_toptips').show();
          $('.bk_toptips span').html('服务端错误');
          setTimeout(function() {$('.bk_toptips').hide();}, 2000);
          return;
        }

        wx.chooseWXPay({
            timestamp: data.timestamp, // 支付签名时间戳，注意微信jssdk中的所有使用timestamp字段均为小写。但最新版的支付后台生成签名使用的timeStamp字段名需大写其中的S字符
            nonceStr: data.nonceStr, // 支付签名随机串，不长于 32 位
            package: data.package, // 统一支付接口返回的prepay_id参数值，提交格式如：prepay_id=***）
            signType: data.signType, // 签名方式，默认为'SHA1'，使用新版支付需传入'MD5'
            paySign: data.paySign, // 支付签名
            success: function (res) {
                // 支付成功后的回调函数
                location.href = '/order_list';
            }
        });
      },
      error: function(xhr, status, error) {
        console.log(xhr);
        console.log(status);
        console.log(error);
        var ua = navigator.userAgent.toLowerCase();//获取判断用的对象
        if (ua.match(/MicroMessenger/i) != "micromessenger") {
          alert('请在微信浏览器中打开');
        }
      }
    });
  }
</script>

@endsection
