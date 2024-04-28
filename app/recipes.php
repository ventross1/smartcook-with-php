<?php
require_once ("SmartCookClient.php");
$request_data = ["attributes" => ["name", "description", "author"]];
$recipeCategory = filter_input(INPUT_GET, "recipe-category", FILTER_SANITIZE_NUMBER_INT);
$test = filter_input(INPUT_GET, "test", FILTER_SANITIZE_NUMBER_INT);
if ($recipeCategory) {
    $request_data["filter"]["recipe_category"] = [$recipeCategory];
}
try {
    $data = (new SmartCookClient)
        ->setRequestData($request_data)
        ->sendRequest("recipes")
        ->getResponseData();
} catch (Exception $e) {
    echo $e->getMessage();
}
$maxlen = 100;
$recipes = "";
$tmpltRecipe = file_get_contents("../web/recipe.html");
foreach($data['data'] as $recipe) {
    if (mb_strlen($recipe["description"]) > $maxlen) {
        $desc = mb_substr($recipe["description"], 0, $maxlen) . " ...";
    }
    $recipes .= str_replace(
        ["{name}", "{description}", "{author}"],
        [ucfirst($recipe["name"]), $desc, $recipe["author"]],
        $tmpltRecipe
    );
}
echo $recipes;
