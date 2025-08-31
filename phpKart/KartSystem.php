<?php

    class KartSystem{

    private array $products;

    private array $kart;

    public function __construct(){
        $this->products = [
            ['id' => 1, 'nome' => 'Processador Intel I5', 'preco' => 879.99, 'estoque' => 45],
            ['id' => 2, 'nome' => 'Processador AMD Ryzen 5', 'preco' => 780.99, 'estoque' => 33],
            ['id' => 3, 'nome' => 'Memória Ram 8GB', 'preco' => 259.99, 'estoque' => 15],
            ['id' => 4, 'nome' => 'Memória Ram 16GB', 'preco' => 500.99, 'estoque' => 50],
            ['id' => 5, 'nome' => 'Memória Ram 32GB', 'preco' => 899.99, 'estoque' => 31],
            ['id' => 6, 'nome' => 'Placa de Vídeo NVDIA RTX 3060 12GB', 'preco' => 1799.99, 'estoque' => 113],
            ['id' => 7, 'nome' => 'Placa de Vídeo AMD RX 6600 8GB', 'preco' => 1499.99, 'estoque' => 92]
        ]; 
    }

    public function getProduct($id){
        foreach($this->products as $product){
            if($product['id'] == $id){
                return $product;
            }
        }

        echo('Produto não existe.');
    }
    public function addKart($id, $quantity){
        $product = $this->getProduct($id);

        $this->kart[] = ['id'=> $product['id'], 'nome' => $product['nome'], 'quantidade' => $quantity];


    }

    public function calculateSubtotal($id, $quantity){
        $product = $this->getProduct($id);
        return $product['preco'] * $quantity;
    }

    public function removeItemFromKart ($id)
    {
        foreach ($this->kart as $index => $item)
        {
            if ($item['id'] == $id) {
                unset($this->kart[$index]);
                $this->kart = array_values($this->kart);
                echo "Item com ID {$id} removido do carrinhos.";
                return;
            }
        }
        echo "Item com ID {$id} não encontrado no carrinho.";
    }
    
    public function aplicarDesconto($subtotal)
    {
        $totalFinal = $subtotal - ($subtotal*0.10);
        return $totalFinal;
    }

    public function listItens()
{
    if (empty($this->kart)) {
        echo "O carrinho está vazio.";
        return;
    }

    echo "<h3>Itens no Carrinho:</h3>";
    foreach ($this->kart as $item) {
        echo "- {$item['nome']} (Quantidade: {$item['quantidade']})<br>";
    }
}


}




?>