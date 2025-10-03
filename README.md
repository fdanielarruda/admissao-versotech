### 🚀 Como Rodar o Projeto

Para visualizar a aplicação no seu navegador, siga os passos em uma das opções abaixo:

### Opção 1: Usando o Servidor Web Embutido do PHP

1.  **Navegue até a pasta principal do código PHP** usando o comando `cd` no seu terminal:

    ```bash
    cd admissao-versotech/php
    ```

    Ou substitua `admissao-versotech` pelo nome real da pasta onde você clonou ou baixou o projeto.

2.  **Inicie o servidor web embutido do PHP** com o seguinte comando:

    ```bash
    php -S 0.0.0.0:7070 -t public
    ```

      * **Observação:** O parâmetro `-t public` é usado para definir o diretório `public` como a **raiz de documentos** do servidor. Isso é crucial para que o roteamento e os arquivos da aplicação sejam carregados corretamente.

3.  **Acesse a aplicação** no seu navegador abrindo o seguinte endereço:

    ```
    http://localhost:7070
    ```

### Opção 2: Usando Docker

1.  **Navegue até a pasta principal do código PHP** (onde o arquivo `docker-compose.yml` está localizado):

    ```bash
    cd admissao-versotech/php
    ```

    Ou substitua admissao-versotech pelo nome real da pasta onde você clonou ou baixou o projeto.

2.  **Suba os contêineres**

    ```bash
    docker compose up --build -d
    ```

3.  **Aguarde alguns instantes** para que o contêiner inicie.

4.  **Acesse a aplicação** no seu navegador. O serviço estará mapeado na mesma porta:

    ```
    http://localhost:7070
    ```

5.  **Para derrubar os contêineres** e liberar a porta, execute na mesma pasta:

    ```bash
    docker compose down
    ```

-----

Qualquer dúvida ou problema na execução, por favor, me avise\!