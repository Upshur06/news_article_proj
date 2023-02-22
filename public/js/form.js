console.log("Form js working");

let categoryError = document.getElementById("categoryError");
let titleError = document.getElementById("titleError");
let imageError = document.getElementById("imageError");
let authorError = document.getElementById("authorError");
let publishDateError = document.getElementById("publishError");
let articleError = document.getElementById("articleError");
let submitBtn = document.getElementById("submit");

function formValidate(event){
    event.preventDefault();
    let formConstraint = {
        category: {
            presence: {
                allowEmpty: false,
                message: "Please enter a category"
            }
        },
        title: {
            presence: {
                allowEmpty: false,
                message: "Please enter a title"
            }
        },
        image: {
            presence: {
                allowEmpty: false,
                message: "Please select an image file"
            }
        },
        name: {
            presence: {
                allowEmpty: false,
                message: "Please enter in a name"
            }
        },
        date: {
            presence: {
                allowEmpty: false,
                message: "Please select in a date"
            }
        },
        article: {
            presence: {
                allowEmpty: false,
                message: "Please fill in"
            }
        },
    };

        categoryError.innerHTML = "";
        titleError.innerHTML = "";
        imageError.innerHTML = "";
        authorError.innerHTML = "" ;
        publishDateError.innerHTML = "";
        articleError.innerHTML = "";

        let formValues =
        {
            category:   document.getElementById("category").value,
            title:      document.getElementById("title").value,
            article:    document.getElementById("story").value,
            image:      document.getElementById("image").value,
            name:       document.getElementById("author").value,
            date:       document.getElementById("publish_date").value,
        };


        let result = validate(formValues, formConstraint);

        if(result){
            console.log(`working`);
            // window.location.assign("/confirm_article");

            // fetch('/create_article', {
            //     method: "POST",
            //     body: JSON.stringify(formValues)
            // })
            // .then((res)=>res.json())
            // .then((data)=>{
            //     console.log(data);
            // })
            // .catch((err) => console.log(err));

            window.location.assign("/article"); 

        }else{
            console.log("NO INFO");
            
            if(result.category !== undefined){
                categoryError.innerHTML = result.category;
            }
            if(result.title !== undefined){
                titleError.innerHTML = result.title;
            }
            if(result.image !== undefined){
                imageError.innerHTML = result.image;
            }
            if(result.name !== undefined){
                authorError.innerHTML = result.name;
            }
            if(result.date !== undefined){
                publishDateError.innerHTML = result.date;
            }
            if(result.article !== undefined){
                articleError.innerHTML = result.article;
            }        
        }
}

