<html>
<head>
</head>
<body style="padding: 20px;  border-radius: 8px;
  border: 1px solid #cbd5e1; background:#f1f5f9;">
   <h2 style="color:#0ea5e9;  text-align: center;
    width: 100%;">Experte academia help</h2>
<hr/>
   <p>Dear Client,</p></br>
  
<p>Your order number :<strong>{{ $mailData['order_number'] }}</strong> has been placed. we are really excited to start working with you on this project.Your order is on its way.</p></br>
<p> Please find below the list of services that will be completed:</p>
<strong>Order number : {{ $mailData['order_number'] }}  -  $ {{ $mailData['total_amount'] }}</strong><br/>

The total amount for this project will be <strong> ${{ $mailData['total_amount'] }}</strong>
<p>click <a href="https://experteacademiahelp.com/tracker/{{ $mailData['order_number'] }}">experteacademiahelp.com/tracker/{{ $mailData['order_number'] }}</a> to track the order progress</p>
     
    <p>Best regards,</p>
     <p>Lehanne.</p>
     <hr/>
</body>
</html>
