# 🛒 CartSystem

Sistema simples de gerenciamento de carrinho de compras desenvolvido em PHP, com funcionalidades básicas de controle de estoque, cálculo de subtotal, aplicação de desconto e finalização de compra.

## 🚀 Como executar

1. Copie a pasta do projeto para dentro da pasta `htdocs` da sua instalação do **XAMPP**.
2. Inicie o **XAMPP** e ative os serviços **Apache**.
3. No navegador, acesse:  
   `http://localhost/Php_CartSystem/Cart/index.php`

---

## 👨‍🎓 Alunos

- **Rodrigo Bassalobre Garcia** – RA: 2007642  
- **Matheus Gomes Pedroza** – RA: 1998912

---

## ✅ Funcionalidades

- Adicionar produtos ao carrinho com verificação de estoque
- Remover produtos do carrinho e restaurar o estoque
- Listar os itens presentes no carrinho com quantidade e subtotal
- Calcular o subtotal por produto e o total geral da compra
- Aplicar cupom de desconto fixo de 10% (`DESCONTO10`)
- Atualizar o estoque automaticamente ao adicionar ou remover produtos
- Exibir resumo completo da compra ao finalizar o carrinho

---

## ⚠️ Limitações

- Os dados não são persistentes (sem banco de dados)
- O sistema não possui interface gráfica (UI)
- O desconto é fixo em 10% e não há suporte para múltiplos cupons

---

## 💡 Regras de Negócio

- O estoque do produto deve ser maior que zero para permitir a adição
- A quantidade solicitada não pode exceder o estoque disponível
- Ao adicionar um produto, o estoque é automaticamente reduzido
- Ao remover um produto, o estoque é restaurado
- O sistema retorna mensagens claras para cada ação (ex: “produto removido”, “estoque insuficiente”)
- O cupom `DESCONTO10` aplica 10% de desconto sobre o valor total da compra
- Produtos repetidos no carrinho têm a quantidade somada, não duplicada

---
