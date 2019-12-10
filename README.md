# hackblog

La tarea de este tema va a consistir en replicar el miniblog que hicimos en PHP y añadir alguna
funcionalidad más. Para ello crea otro proyecto symfony (symfonyBlog) y haz las siguientes cosas:
Coloca la carpeta con las imágenes y el archivo css en la carpeta public.
Crea una clase BlogController con dos controladores, uno para la portada y otro para ver una
noticia. El primero en la ruta / y el segundo en la ruta /noticia/{id}.
Crea una plantilla llama blogBase.html.twig que contenga la parte del HTML que se generaba
con theHeader() y theFooter(). Añade un bloque para poder cambiar el título de la
página, otro para los estilos CSS y otro para el div main.
Crea una plantilla para la portada y otra para ver una noticia, que hereden de
blogBase.html.twig. De momento no mostrarán la noticias, sino un mensaje que diga “Esta es
la portada” o “Esta es una noticia”.
