var nombre = 0;
var compteLike = document.querySelector('#compteurLike');
var imgLike = document.getElementById('like');
if (nombre == 0)
{
  imgLike.addEventListener('click',()=>
{
  nombre = nombre + 1; 
  compteLike.textContent = nombre;
})
}  


