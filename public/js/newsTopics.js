// console.log("News Topic working");

// let randomArticleTopics = document.getElementById('randomArticleTopics');

// fetch('/article/randomtopics')
// .then((res) => res.json())
// .then((data) => {
//     console.log(data);
//     data.forEach((news)=>{
//         console.log(news['image']);
//         console.log(news['story']);
//         console.log(news['title']);

//         randomArticleTopics.innerHTML += `
//             <div class="col-3 d-flex flex-wrap">
//                 <img class="me-2" [src]={'\images\'${news['image']}} width="125" height="150" alt="">                
//                 <div style="width: 120px; height:155px; overflow:hidden">
//                     <h5>${news['title']}</h5>
//                     <p>${news['story']}</p>
//                 </div>
//             </div>
//         `;
//     })

// })
// .catch((err) => console.log(err));