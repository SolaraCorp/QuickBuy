<?php
require_once '../config/database.php';

//obtem o ID do produto da URL
$product_id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$product_id) {
    header('Location: index.php');
    exit();
}

//conecta com o banco de dados
$database = new Database();
$db = $database->getConnection();

//busca o produto pelo id
$query = "SELECT * FROM products WHERE id_product = ?";
$stmt = $db->prepare($query);
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <title>QuickBuy - <?php echo htmlspecialchars($product['name']); ?></title>
</head>
<body>
    <header>
        <a class="logo-name" href="index.php">
            <img id="logo" src="../images/header/QuickBuy-logo.png">
            <img id="name" src="../images/header/QuickBuy-Name(3).png">
        </a>
        <div class="search-bar">
            <input type="text" id="search-box" placeholder="Pesquise algo...">
            <button class="search-button" id="s-button"><img src="../images/header/procurar.png" height="50vh"></button>
        </div>
        <div class="header-options">
            <div class="profile-dropdown">
                <button class="profile-button" onclick="toggleDropdown()"><img src="../images/header/perfil.png"></button>
                <div class="dropdown-content">
                    <a href="profile.html">Meu Perfil</a>
                    <a href="purchases.html">Minhas Compras</a>
                    <a href="payment-methods.html">Formas de Pagamento</a>
                </div>
            </div>
            <button class="chart-button"><img src="../images/header/carrinho-de-compras (2).png"></button>
        </div>
    </header>
    <main>
        <div class="product-container">
            <div class="product-image">
                <img src="<?php echo empty($product['image_url']) ? '../images/body/placeholder-product.png' : $product['image_url']; ?>"
                     onerror="this.src='../images/body/placeholder-product.png'"
                     alt="<?php echo htmlspecialchars($product['name']); ?>">
            </div>
            <div class="product-info">
                <h1 class="product-name"><?php echo htmlspecialchars($product['name']); ?></h1>
                <p class="product-price">R$ <?php echo number_format($product['price'], 2, ',', '.'); ?></p>
                <p class="product-description"><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
                
                <div class="quantity-control">
                    <button onclick="updateQuantity(-1)">-</button>
                    <input type="number" id="quantity" value="1" min="1" max="<?php echo $product['stock']; ?>">
                    <button onclick="updateQuantity(1)">+</button>
                </div>
                
                <button class="add-to-cart" onclick="addToCart(<?php echo $product['id_product']; ?>)">
                    Adicionar ao Carrinho
                </button>
                
                <p class="product-stock">
                    Estoque disponível: <?php echo $product['stock']; ?> unidades
                </p>
            </div>
        </div>
    </main>
    <script src="../scripts/dropdown-behavior.js"></script>
    <script>
        function updateQuantity(change) {
            const input = document.getElementById('quantity');
            const currentValue = parseInt(input.value);
            const maxValue = parseInt(input.max);
            
            let newValue = currentValue + change;
            if (newValue < 1) newValue = 1;
            if (newValue > maxValue) newValue = maxValue;
            
            input.value = newValue;
        }

        function addToCart(productId) {
            const quantity = document.getElementById('quantity').value;
            //#TODO Lógica do carrinho vem aqui na teoria
            alert('Produto adicionado ao carrinho!');
        }
    </script>
</body>
</html> 