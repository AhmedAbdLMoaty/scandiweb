<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/app/views/ProductList.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Product List</h1>
    <form id="delete-form" method="post" action="<?= BASE_URL ?>/home/delete_products">
        <div class="product-actions">
            <a href="<?= BASE_URL ?>/add-product" id="add-product-btn">ADD</a>
            <button id="delete-product-btn" type="submit">MASS DELETE</button>
        </div>
        <div class="product-list">
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <input type="checkbox" name="product_ids[]" class="delete-checkbox" value="<?= $product['sku']; ?>">
                    <div class="product-info">
                        <p><strong><?= $product['sku']; ?></strong></p>
                        <p><?= $product['name']; ?></p>
                        <p><?= $product['price']; ?> $</p>
                        <p><?= $product['type'] === 'DVD' ? "Size: " . $product['size_mb'] . " MB" : ($product['type'] === 'Book' ? "Weight: " . $product['weight_kg'] . " Kg" : "Dimensions: " . $product['dimensions_cm']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </form>

    <script>
        $(document).ready(function() {
            $('#delete-form').on('submit', function(event) {
                event.preventDefault(); 

                $.ajax({
                    url: '<?= BASE_URL ?>/home/delete_products',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        location.reload(); 
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script>
</body>
</html>