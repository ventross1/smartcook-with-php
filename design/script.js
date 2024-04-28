const api_url = "http://localhost/smartcook-with-php/app/"
function load(url, element) {
  fetch(url)
    .then((response) => response.text())
    .then((data) => {
      element.innerHTML = data
    })
}
load(api_url + "recipes.php", document.getElementById("recipes"))
let b = 10;
let buttons = document.querySelectorAll("#recipe-category-btns button")
buttons.forEach((button) => {
  button.onclick = () => {
    buttons.forEach((button) => {
      button.classList.remove("active")
    })
    button.classList.add("active")
    let category = button.getAttribute("data-recipe-category")
    let authortest = button.getAttribute("test")
    load(
      api_url + "recipes.php?recipe-category=" + category,
      document.getElementById("recipes")
    )
  }
  })