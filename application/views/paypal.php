<?php
define('ProPayPal', 0);
if(ProPayPal){
    define("PayPalClientId", "*********************");
    define("PayPalSecret", "*********************");
    define("PayPalBaseUrl", "https://api.paypal.com/v1/");
    define("PayPalENV", "production");
} else {
    define("PayPalClientId", "AVw6a0qki2LSaKShcKzL1DY9v7GuhbAVJfh6qK9_8TQ8xQaNnndXG_fi08phj1Dqs2ofcUyOnhRnuph");
    define("PayPalSecret", "EBXuzlPhM3O_wiDchJAIuMQYAfXWgPH_5x1hcEycG1YKK0uiz-twWvD7XFkj4aofseVy0t0qRMwyqk00");
    define("PayPalBaseUrl", "https://api.sandbox.paypal.com/v1/");
    define("PayPalENV", "sandbox");
}
?>