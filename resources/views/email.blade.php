<!DOCTYPE html>
<html>
   <head>
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <style type="text/css">
         #invoice{
         padding: 30px;
         }
         .invoice {
         position: relative;
         background-color: #FFF;
         min-height: 680px;
         padding: 15px
         }
         .invoice header {
         padding: 10px 0;
         margin-bottom: 20px;
         border-bottom: 1px solid #3989c6
         }
         .invoice .company-details {
         text-align: right
         }
         .invoice .company-details .name {
         margin-top: 0;
         margin-bottom: 0
         }
         .invoice .contacts {
         margin-bottom: 20px
         }
         .invoice .invoice-to {
         text-align: left
         }
         .invoice .invoice-to .to {
         margin-top: 0;
         margin-bottom: 0
         }
         .invoice .invoice-details {
         text-align: right
         }
         .invoice .invoice-details .invoice-id {
         margin-top: 0;
         color: #3989c6
         }
         .invoice main {
         padding-bottom: 50px
         }
         .invoice main .thanks {
         margin-top: -100px;
         font-size: 2em;
         margin-bottom: 50px
         }
         .invoice main .notices {
         padding-left: 6px;
         border-left: 6px solid #3989c6
         }
         .invoice main .notices .notice {
         font-size: 1.2em
         }
         .invoice table {
         width: 100%;
         border-collapse: collapse;
         border-spacing: 0;
         margin-bottom: 20px
         }
         .invoice table td,.invoice table th {
         padding: 15px;
         background: #eee;
         border-bottom: 1px solid #fff
         }
         .invoice table th {
         white-space: nowrap;
         font-weight: 400;
         font-size: 16px
         }
         .invoice table td h3 {
         margin: 0;
         font-weight: 400;
         color: #3989c6;
         font-size: 1.2em
         }
         .invoice table .qty,.invoice table .total,.invoice table .unit {
         text-align: right;
         font-size: 1.2em
         }
         .invoice table .no {
         color: #fff;
         font-size: 1.6em;
         background: #3989c6
         }
         .invoice table .unit {
         background: #ddd
         }
         .invoice table .total {
         background: #3989c6;
         color: #fff
         }
         .invoice table tbody tr:last-child td {
         border: none
         }
         .invoice table tfoot td {
         background: 0 0;
         border-bottom: none;
         white-space: nowrap;
         text-align: right;
         padding: 10px 20px;
         font-size: 1.2em;
         border-top: 1px solid #aaa
         }
         .invoice table tfoot tr:first-child td {
         border-top: none
         }
         .invoice table tfoot tr:last-child td {
         color: #3989c6;
         font-size: 1.4em;
         border-top: 1px solid #3989c6
         }
         .invoice table tfoot tr td:first-child {
         border: none
         }
         .invoice footer {
         width: 100%;
         text-align: center;
         color: #777;
         border-top: 1px solid #aaa;
         padding: 8px 0
         }
         @media print {
         .invoice {
         font-size: 11px!important;
         overflow: hidden!important
         }
         .invoice footer {
         position: absolute;
         bottom: 10px;
         page-break-after: always
         }
         .invoice>div:last-child {
         page-break-before: always
         }
         }
      </style>
      <!------ Include the above in your HEAD tag ---------->
   </head>
   <body>
      <div id="invoice">
         <div class="toolbar hidden-print">
            <div class="text-right">
               <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
              </div>
            <hr>
         </div>
         <div class="invoice overflow-auto">
            <div style="min-width: 600px">
               <header>
                  <div class="row">
                     <div class="col">
                        <a target="_blank" href="http://largeskill.com">
                        <img src="{{ URL::to('/') }}/images/logs.jpg" name="logo" style="height: 40px;" />
                        </a>
                     </div>
                     <div class="col company-details">
                        <h2 class="name">
                           <a target="_blank" href="http://largeskill.com">
                           Large Skill
                           </a>
                        </h2>
                        <div>"Head Office" - 3400 Cottage Way, Suite G2 #263, Sacramento, CA 95825, USA</div>
                        <div>1-925-953-8773, 1-925-953-8672</div>
                        <div>suppport@largeskill.com</div>
                     </div>
                  </div>
               </header>
               <main>
                  <div class="row contacts">
                     <div class="col invoice-to">
                        <div class="text-gray-light">INVOICE TO:</div>
                        <h2 class="to">{{ $user_data->name }}</h2>
                        <div class="address">{{$user_data->address}}</div>
                        <div class="email"><a href="{{$user_data->email}}">{{$user_data->email}}</a></div>
                     </div>
                     <div class="col invoice-details">
                        <h1 class="invoice-id">INVOICE 344</h1>
                        <div class="date">Date of Invoice: {{$user_data->created_at}}</div>                       
                     </div>
                  </div>
                  <table border="0" cellspacing="0" cellpadding="0">
                     <thead>
                        <tr>
                           <th>#</th>
                           <th class="text-left">Product Id</th>
                           <th class="text-right">Name</th>
                           <th class="text-right">Package</th>
                           <th class="text-right">Qty</th>
                           <th class="text-right">Price</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                           $ctr = 1;
                           $tot = 0;
                        ?>
                        @foreach($orders as $product)
                        <?php 
                           $price = $product['qty'] * $product['price']; 
                           $qty = $product['qty'] * $product['pills']; 
                           $subtot = $tot + $price; 
                        ?>
                        <tr>
                           <td class="no">{{$ctr}}</td>
                           <td class="unit">{{ $product['product_id'] }}</td>
                           <td class="text-left">
                              <h3>
                                 {{$product['name']}}
                              </h3>
                           </td>
                           <td class="unit">{{ $product['qty'] }}</td>
                           <td class="qty">{{$qty}}</td>
                           <td class="total">${{$price}}</td>
                        </tr>
                        <?php $ctr++; ?>                        
                        @endforeach
                     </tbody>
                     <tfoot>
                        <?php 
                           if($user_data->shipping == "Standard") {
                              $shipAmount = 20;
                           } else {
                              $shipAmount = 25;

                           }
                           $grand = $subtot + $shipAmount;
                        ?>
                        <tr>
                           <td colspan="3"></td>
                           <td colspan="2">SUBTOTAL</td>
                           <td>${{$subtot}}</td>
                        </tr>
                        <tr>
                           <td colspan="3"></td>
                           <td colspan="2">Shipping</td>
                           <td>${{$shipAmount}}</td>
                        </tr>
                        <tr>
                           <td colspan="3"></td>
                           <td colspan="2">GRAND TOTAL</td>
                           <td>${{$grand}}</td>
                        </tr>
                     </tfoot>
                  </table>
                  <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">Name on Card</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Billing Address</th>
                        <th scope="col">Credit Card Number</th>
                        <th scope="col">Expiry Date</th>
                        <th scope="col">CVV</th>
                        <th scope="col">Shipping</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <?php 
                           if($user_data->shipping == "Standard") {
                              $sprice = 20;
                           } else {
                              $sprice = 25;
                           }
                        ?>
                        <th scope="row">{{ $user_data->name }}</th>
                        <td>{{ $user_data->mobile }}</td>
                        <td>{{ $user_data->bill_address }}</td>
                        <td>{{ $user_data->ccno }}</td>
                        <td>{{ $user_data->expiry_date }}</td>
                        <td>{{ $user_data->cvv }}</td>
                        <td>{{ $user_data->shipping }} ${{ $sprice }}</td>
                      </tr>
                      
                    </tbody>
                  </table>
                  
                  <div class="thanks">Thank you!</div>
                  <div class="notices">
                     <div>NOTICE:</div>
                     <div class="notice"></div>
                  </div>
               </main>
               <footer>
                  This is an auto generated invoice.
               </footer>
            </div>
            <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
            <div></div>
         </div>
      </div>
   </body>
   <script type="text/javascript">
		$('#printInvoice').click(function(){
        	Popup($('.invoice')[0].outerHTML);
        	function Popup(data) 
        	{
            	window.print();
            	return true;
        	}
        });
   </script>
</html>