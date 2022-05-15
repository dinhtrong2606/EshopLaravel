<html>
	<head>
		<meta charset="utf-8">
		<title>Invoice</title>
		<link rel="stylesheet" href="{{url('frontend/css/mail_order.css')}}">
	</head>
	<body>
		<header>
			<h1 style="text-align: center">Thông báo đặt hàng thành công</h1>
			<address contenteditable>
				<p>Tên người đặt: {{ $infoUser->customer_name }}</p>
				<p>SDT: {{ $infoUser->customer_phone }}</p>
			</address>
		</header>
		<article>
			<table class="meta" border="1" cellspacing="0" cellpadding="10" style="width: 100%;margin-bottom: 20px">
				<tr>
					<th><span contenteditable>Mã đơn hàng #</span></th>
					<td><span contenteditable>{{ $order_status->order_id }}</span></td>
				</tr>
				<tr>
					<th><span contenteditable>Ngày đặt</span></th>
					<td><span contenteditable>{{ $order_status->created_at }}</span></td>
				</tr>
			</table>
			<table class="inventory" border="1" cellspacing="0" cellpadding="10" style="width: 100%;margin-bottom: 30px">
				<thead>
					<tr>
						<th><span contenteditable>Product Name</span></th>
						<th><span contenteditable>Quantity</span></th>
						<th><span contenteditable>Total</span></th>
					</tr>
				</thead>
				<tbody>
                    @php
                    $total = 0;
                    @endphp
                    @foreach($orders as $key => $order)
                    @php
                    $subtotal = $order->product_sales_quantity * $order->product_price;
                    $total += $subtotal;
                    @endphp
					<tr>
						<td style="text-align: center"><h4>{{$order->products->product_name}}</h4></td>
						<td style="text-align: center"><span contenteditable>{{$order->product_sales_quantity}}</span></td>
						<td style="text-align: center"><span contenteditable>{{number_format($subtotal) . ' vnd'}}</span></td>
					</tr>
                    @endforeach
				</tbody>
			</table>
            <hr>
            <h3><i>Total: {{number_format($total) . ' vnd'}}</i></h3>
		</article>
		<aside>
			<div contenteditable>
				<b style="text-align: center"><i>Đơn hàng của bạn sẽ được gửi đi trong vòng 24h tới. Cảm ơn bạn đã ủng hộ shop của chúng tôi !</i></b>
			</div>
		</aside>
	</body>
</html>