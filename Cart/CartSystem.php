<?php

class CartSystem
{

    private array $products;

    private array $cart;

    public function __construct() {
        $this->products = [
            ['id' => 1, 'nome' => 'Processador Intel Core i5-12400F', 'preco' => 879.99, 'estoque' => 45],
            ['id' => 2, 'nome' => 'Processador AMD Ryzen 5 5600X', 'preco' => 780.99, 'estoque' => 33],
            ['id' => 3, 'nome' => 'Memória RAM DDR4 8GB 3200MHz Corsair', 'preco' => 259.99, 'estoque' => 15],
            ['id' => 4, 'nome' => 'Memória RAM DDR4 16GB 3600MHz Kingston', 'preco' => 500.99, 'estoque' => 50],
            ['id' => 5, 'nome' => 'Memória RAM DDR4 32GB 3600MHz G.Skill', 'preco' => 899.99, 'estoque' => 31],
            ['id' => 6, 'nome' => 'Placa de Vídeo NVIDIA GeForce RTX 3060 12GB', 'preco' => 1799.99, 'estoque' => 113],
            ['id' => 7, 'nome' => 'Placa de Vídeo AMD Radeon RX 6600 8GB', 'preco' => 1499.99, 'estoque' => 92],
            ['id' => 8, 'nome' => 'Processador Intel Core i7-13700K', 'preco' => 2299.90, 'estoque' => 20],
            ['id' => 9, 'nome' => 'Processador AMD Ryzen 7 5800X3D', 'preco' => 1899.00, 'estoque' => 18],
            ['id' => 10, 'nome' => 'Placa de Vídeo NVIDIA GeForce RTX 4070 Ti 12GB', 'preco' => 3999.99, 'estoque' => 12],
            ['id' => 11, 'nome' => 'Placa de Vídeo AMD Radeon RX 7900 XT 20GB', 'preco' => 4299.00, 'estoque' => 10],
            ['id' => 12, 'nome' => 'Processador Intel Core i9-14900K', 'preco' => 3499.90, 'estoque' => 8],
            ['id' => 13, 'nome' => 'Processador AMD Ryzen 9 7950X', 'preco' => 3699.00, 'estoque' => 6],
            ['id' => 14, 'nome' => 'Placa de Vídeo NVIDIA GeForce RTX 4080 16GB', 'preco' => 5999.99, 'estoque' => 5],
            ['id' => 15, 'nome' => 'Placa de Vídeo AMD Radeon RX 7800 XT 16GB', 'preco' => 3499.00, 'estoque' => 7],
            ['id' => 16, 'nome' => 'SSD NVMe M.2 1TB Samsung 980 Pro', 'preco' => 699.90, 'estoque' => 60],
            ['id' => 17, 'nome' => 'HD SATA 2TB Seagate Barracuda', 'preco' => 349.99, 'estoque' => 120],
            ['id' => 18, 'nome' => 'Fonte Corsair RM750x 750W 80 Plus Gold', 'preco' => 599.90, 'estoque' => 35],
            ['id' => 19, 'nome' => 'Gabinete NZXT H510 com vidro temperado', 'preco' => 499.99, 'estoque' => 22],
            ['id' => 20, 'nome' => 'Cooler CPU Noctua NH-D15', 'preco' => 599.00, 'estoque' => 18]
        ];
    }

    public function getProduct($id) {
        foreach ($this->products as $product) {
            if ($product['id'] == $id) {
                return $product;
            }
        }

        echo ('Produto não existe. <br>');
    }

    public function listItens() {
        
        if (empty($this->cart)) {
            echo "O carrinho está vazio.";
            return;
        }

        echo "<h3>Itens no Carrinho:</h3>";
        foreach ($this->cart as $item) {
            echo "- {$item['nome']} (Quantidade: {$item['quantidade']}) <br>";
        }
    }

    public function addCart($id, $quantity) {
        if ($this->validateProductExist($id) == false) {
            echo ("Produto não existe. <br>");
            return;
        }

        if ($this->validateStock($id) == false) {
            echo ("Produto não possui estoque. <br>");
            return;
        }
        if ($this->validateQuantity($id, $quantity) == false) {
            echo ("Estoque insuficiente. <br>");
            return;
        }

        $product = $this->getProduct($id);

        $this->cart[] = ['id' => $product['id'], 'nome' => $product['nome'], 'quantidade' => $quantity, 'subtotal' => $this->calculateSubtotal($id, $quantity)];
        $this->updateStock($id, $quantity, '-');

        echo("Produto { {$product['nome']} } adicionado ao Carrinho. <br>");
    }

    public function removeItemFromCart($id) {

        foreach ($this->cart as $index => $item) {
            if ($item['id'] == $id) {
                $quantidade = $item['quantidade'];


                unset($this->cart[$index]);
                $this->cart = array_values($this->cart);

                $this->updateStock($id, $quantidade, '+');

                echo "Produto: { {$item['nome']} } removido, estoque restaurado. <br>";
                return;
            }
        }
        echo "Item com ID {$id} não encontrado no carrinho. <br>" ;
    }

    public function validateProductExist($id) {
        foreach ($this->products as $product) {
            if ($product['id'] == $id) {
                return true;
            }
        }
        return false;
    }

    public function validateStock($id) {
        foreach ($this->products as $product) {
            if ($product['id'] == $id && $product['estoque'] > 0) {
                return true;
            }
        }
        return false;
    }

    public function validateQuantity($id, $quantity) {
        foreach ($this->products as $product) {
            if ($product['id'] == $id && $quantity <= $product['estoque']) {
                return true;
            }
        }
        return false;
    }

    public function updateStock($id, $quantity, $operator) {
        if ($operator == '-') {
            foreach ($this->products as &$product) {
                if ($product['id'] == $id) {
                    $product['estoque'] -= $quantity;
                    return;
                }
            }
        }

        if ($operator == '+') {
            foreach ($this->products as &$product) {
                if ($product['id'] == $id) {
                    $product['estoque'] += $quantity;
                    return;
                }
            }
        }
    }

    public function calculateSubtotal($id, $quantity) {
        
        $product = $this->getProduct($id);
        return $product['preco'] * $quantity;
    }

    public function calculateDiscount($total) {
        $totalFinal = $total - ($total * 0.10);
        return $totalFinal;
    }

    public function calculateTotal($desconto = null) {

        $total = 0;
        foreach ($this->cart as $product) {
            $total += $product['subtotal'];
        }

        if ($desconto == "DESCONTO10") {
            $total = $this->calculateDiscount($total);
        }

        return $total;
    }

    public function finishCart($cupom = null) {
        $total = $this->calculateTotal($cupom);

        if($total <= 0) {
            echo("Carrinho vazio. <br>");
            return;
        }

        if($cupom == 'DESCONTO10') {
            echo("Carrinho finalizado! <br>
            Valor total com desconto de 10%: R$ {$total}");
            return $total;
        }
        echo("Carrinho finalizado! <br>
            Valor total: R$ {$total}");


    }
}
