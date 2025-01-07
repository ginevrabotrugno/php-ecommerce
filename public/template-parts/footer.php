<?php 
$cm = new CartManager();
$cartId = $cm->getCurrentCartId();
$cart_total = $cm->getCartTotal($cartId);
?>

<footer class="bg-dark">
        <div class="container">
            <hr>
            <p class="text-light"> Copyright &copy; 2024</p>
        </div>
    </footer>
   <script src="https://bootswatch.com/_vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://bootswatch.com/_vendor/prismjs/prism.js"></script>

   <script src="<?php echo ROOT_URL; ?>assets/js/main.js"></script>
   <script>
        cart_badge = document.getElementById("js-totCart");
        cart_badge.innerText = "<?php echo $cart_total['num_products']?>"
   </script>
</body>
</html>