# Iniciação Científica

Neste repositório consta o código-fonte desenvolvido para o sistema de Iniciação Científica realizado pela [**Equipe Web**](https://fatecrl.edu.br/setores/equipe-web) da **Fatec Rubens Lara**.

## Ambiente de testes

Segue abaixo a URL utilizada para a realização de testes da sistema:<br>

[**> iniciacao-cientifica.herokuapp.com**](https://iniciacao-cientifica.herokuapp.com/)

## Configuração

**1 | Clonar o projeto para sua máquina:**

```bash
git clone https://gitlab.com/SiteFatec/IniciacaoCientifica
```

**3 | [NOVO] Configure sua URL local**

Duplique o arquivo `config.example.php` existente em [application/config](https://gitlab.com/SiteFatec/IniciacaoCientifica/tree/master/application/config) e renomeie este novo arquivo para `config.php`.

> Após feito a etapa anterior, lembre-se de **manter** o  `config.example.php`!

Após feita a duplicação e nomeação do arquivo conforme informado anteriormente, altere o valor `base_url` de modo a fazer com que o caminho corresponda ao diretório em que o seu projeto está localizado localmente em sua máquina:

```php
$config['base_url'] = 'http://localhost/caminho/ate/o/diretorio'
```

*Como sei o caminho a ser inserido no `base_url`?*

Se você utiliza o **XAMPP**, o seu projeto deverá estar dentro do diretório `htdocs`. Este mesmo `htdocs` é o seu ponto de partida. 

Exemplo:

1. Localização na máquina:<br>
`C:/xampp/htdocs/projetos/iniciacao-cientifica`

2. Configuração do `base_url`:<br>

```php
$config['base_url'] = 'http://localhost/projetos/iniciacao-cientifica/'
```

Como visto acima, não é necessário inserir 'htdocs' no caminho, somente o que está a partir disso.