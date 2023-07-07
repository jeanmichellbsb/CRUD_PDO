Faculdade de Tecnologia Senac DF 			
Linguagem Tecnica de Programacao II - ADS MAT3A 
Professor: Márcio Araya		
Alunos: Ana Clara Lopes Brandão
			  Jean Michell de Oliveira Moura
			  Wilmondes Gabriel Teixeira Alves


Respostas

1. No contexto da programação orientada a objetos, explique o que é uma "interface". 
Interfaces servem para sinalizar todos métodos que serão implementados por uma classe, sem implementá-los de fato. São definidas com o uso da palavra reservada interface. São semelhantes a um contrato, em que todos os métodos são abstratos por não terem seu conteúdo definido e quando a interface é usada em uma classe ela irá sobrescrever o código de implementação.

2. O que são "traits" no PHP?
Traits são um mecanismo para reutilização de código em linguagens de herança única, como PHP.  É uma adição à herança tradicional e permite a composição horizontal do comportamento, ou seja, a aplicação de membros de classe sem exigir herança. 
Um Trait destina-se a reduzir algumas limitações de herança única, permitindo que um desenvolvedor reutilize conjuntos de métodos livremente em várias classes independentes vivendo em diferentes hierarquias de classes. Um Trait é semelhante a uma classe, mas destina-se apenas a agrupar funcionalidades de maneira refinada e consistente. Não é possível instanciar um Trait sozinho.
A semântica da combinação de Traits e classes é definida de forma a reduzir a complexidade e evitar os problemas típicos associados à herança múltipla e Mixins.
“Compartilhamento de métodos e propriedades sem esteder as classes”
“Herança horizontal pois não há mudança no nível de hierarquia”
3. No código aparece o método "bindValue" do PDO para definir o valor que será utilizado na execução da instrução SQL. No PDO, também existe o método "bindParam". Qual(is) a(s) diferença(s) entre eles?
O método bindValue passa o valor por chamada de método, esse valor é enviado e imutável, sendo sua implementação mais comum. Já o método bindParam passa o valor por referência, ou seja ele é associado a uma variável e pode ser mutável.
 

