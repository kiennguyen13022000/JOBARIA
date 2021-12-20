<?php
?>
<main id="main" class="page_list">
    <nav aria-label="breadcrumb" class="nav_breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cart</li>
            </ol>
        </div>

    </nav>
    <section class="main_page main_page_cart">
        <div class="container">
            <div class="main_cart">
                <h2>Congratulations on your order successfully</h2>
            </div>
        </div>

    </section>
</main>
<script>
    localStorage.removeItem('products');
    localStorage.removeItem('checkout');

</script>