console.log('Story Articles working');

let newTopics = document.getElementById('new_topics');

fetch('/article/stories')
.then((res)=>res.json())
.then((data)=>{
    // console.log(data);

    data.forEach((articleObj)=>{
        console.log(articleObj['id']);
        console.log(articleObj['author']);
        console.log(articleObj['category']);
        console.log(articleObj['image']);
        console.log(articleObj['publish_date']);
        console.log(articleObj['story']);
        console.log(articleObj['title']);

        newTopics.innerHTML += `
        <div class="my-4 px-4 py-2 bg-light" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;">
            <h3 class="">${articleObj['title']}</h3>
            <div style="border:1px solid green; margin-bottom: 7px;"></div>
            <div class="d-flex px-2 justify-content-between">
                <p class="pe-2">
                    <img src="images/person-fill.svg" alt="">Posted By: ${articleObj['author']} 
                </p>
                <p class="pe-2">
                    <img src="images/clock-fill.svg" alt="">
                    ${articleObj['publish_date']} 
                </p>
                <p class="pe-2">
                    <span class="badge text-warning" style="margin-top:3px; position:absolute; top:80;left:818">
                    4</span> 
                    <img src="images/heart-fill.svg" alt="">
                    Likes
                </p>
            </div>
            <div style="border:1px solid green; margin-top:0; margin-bottom:5px"></div>
            <div class="d-flex flex-wrap">
                <div class="me-3">
                    <img style="border:2px solid black;" src="\images\${articleObj['image']}" height="150" alt="">
                </div>
                <p class="px-2 col-7" style="width: 35vw; height:155px; overflow:hidden"> ${articleObj['story']} </p>
            </div>
            <div class="d-flex justify-content-between mt-2">
                <div class="">
                    <p> Category: ${articleObj['category']} </p>
                </div>
                <div>
                    <button class="btn btn-info text-light "><a href="/news/${articleObj['id']}" style="text-decoration:none; color:white">Continue Reading</a></button>
                </div>
            </div>
        </div>
        `;
    })
})
.catch((err)=>console.log(err));