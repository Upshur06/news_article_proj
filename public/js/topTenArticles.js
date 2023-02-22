// console.log('Top 10 Articles Working');
let topTenArticles = document.getElementById('topTenArticles');

fetch('/article/top10')
.then((res) => res.json())
.then((data) => {
    // console.log(data);
    data.forEach((article)=> {
        // console.log(article.title);
        // console.log(article.story);

        topTenArticles.innerHTML += `
            <div style="height:130px; overflow: hidden">
                <h5> <a style="text-decoration: none; color:white" href=""> ${article['title']} </a> </h5>
                <p class="fs-6"> ${article['story']} </p>
            </div>
            <hr>
        `
    })
})
.catch((err) => console.log(err));