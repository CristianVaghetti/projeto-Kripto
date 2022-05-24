Projeto em Laravel para criação de uma "Command" que verifica o preço de uma criptomoeda específica e guarda o preço no banco de dados. Utilizado a API da Binance para coleta dos dados.

=> composer install é o suficiente para instalar as dependências do projeto.

        --Guia de utilização--

=> primeiramente DEVE rodar o comando
    
    --php artisan c:getAllKriptos--

Esse comando é responsável por montar uma tabela somente com os nomes das criptomoedas. o ID das criptos vai viajar pra tabela dos preços, assim, é possível que seja monitorado várias criptos, uma vez que o preço está endereçado a sua respectiva cripto.

=> para salvar o preço de uma cripto uso o comando
    
    --php artisan c:saveBidPriceOnDataBase {symbol}-- 
    
    exemplo de utilização: php artisan c:saveBidPriceOnDataBase BTCUSDT

Eu tomei a liberdade de alterar o comando adicionando um parâmetro a ser enviado junto. Dessa maneira, é possível já enviar qual moeda deseja atualizar o preço. Reforçando a ideia de que mais de uma moeda será monitorada. O symbol precisa ser idêntico ao nome da moeda, se não não sera localizada a cripto.

=> para checar se o último registro está 0.5% abaixo da média use o comando
   
   --php artisan c:checkAvgBigPrice {symbol}--
   
    exemplo de utilização: php artisan c:checkAvgBigPrice BTCUSDT
 
 No mesmo sentido do comando anterior, é possível fazer a checagem isolada de cada criptomoeda registrada no banco passando o nome dela como parâmetro.
 O retorno será da seguinte maneira:
    Média das últimas 100 medições
    A última medição
    O valor da diferença em percentual
    A mensagem de acordo com o valor da diferença
