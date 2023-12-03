function updatePageContents(searchTearms){
    if (!sessionStorage.getItem("currentPage")){
        currentPage = sessionStorage.setItem("currentPage", 1);
    } else {
        currentPage = sessionStorage.getItem("currentPage");
    }
    getProducts(currentPage, searchTearms);
    console.log(currentPage)
}

function updatePageNumber(newPageNumber){
    sessionStorage.setItem("currentPage", newPageNumber);
    updatePageContents(null);
}

function prevPage(){
    console.log("prev");
    currentPage = parseInt(sessionStorage.getItem("currentPage"))-1;
    updatePageNumber(currentPage);
}

function nextPage(){
    console.log("next");
    currentPage = parseInt(sessionStorage.getItem("currentPage"))+1;
    updatePageNumber(currentPage);
}

function getProducts(pageNumber, searchTearms){
    $.ajax({
        url:"includes/productPageNav.php",    //the page containing php script
        type: "post",    //request type,
        dataType: 'json',
        data: {maxResultsPerPage: 8, pageNumber: pageNumber, searchTearms: searchTearms},
        success:function(result){
            displayProducts(result.products);
            updatePagination(currentPage, result.numberOfPages);
        }
    });
    return null;
}

function displayProducts(products){
    productContainer = document.getElementById('products'); // Get container to put data into
    productContainer.innerHTML = ""; // Clear container to remove old products
    for (i in products){
        // Construct card elements
        div =  card = document.createElement("div");
        card.setAttribute('class','col mt-2');

        card = document.createElement("div");
        card.setAttribute('class','card bg-dark text-white');
        div.appendChild(card);

        image = document.createElement("img");
        image.setAttribute('class','card-img-top');
        if (products[i].image){
            image.src = products[i].image;
        } else {
            image.src = "images/product placeholders/product placeholder.jpg";
            image.alt = "no image for this product exists";
        }
        
        card.appendChild(image);

        cardBody = document.createElement("div");
        cardBody.setAttribute('class','card-body');
        card.appendChild(cardBody); // Nests card within the mainDiv

        // Top row elements (price)
        topRow = document.createElement("div");
        topRow.setAttribute('class','row');
        cardBody.appendChild(topRow);

        topLeftCol = document.createElement("div");
        topLeftCol.setAttribute('class','col-8');
        topRow.appendChild(topLeftCol);

        productTitle = document.createElement("h5");
        productTitle.setAttribute('class','card-title');
        productTitle.innerHTML = products[i].ProductName;
        topLeftCol.appendChild(productTitle);

        topRightCol = document.createElement("div");
        topRightCol.setAttribute('class','col-4');
        topRow.appendChild(topRightCol);

        productCost = document.createElement("h5");
        productCost.setAttribute('class','card-title');
        topRightCol.appendChild(productCost);
        productCost.innerHTML = "£"+products[i].SellingPrice;

        midRow = document.createElement("div");
        midRow.setAttribute('class','row mb-1');
        cardBody.appendChild(midRow);

        productDescription = document.createElement("p");
        productDescription.setAttribute('class','card-text crop-text-2');
        productDescription.innerHTML = products[i].ProductCategory;
        midRow.appendChild(productDescription);

        bottomRow = document.createElement("div");
        bottomRow.setAttribute('class','row');
        cardBody.appendChild(bottomRow);

        buttonGroup = document.createElement("div");
        buttonGroup.setAttribute('class','btn-group');
        buttonGroup.setAttribute('data-toggle','buttons');
        bottomRow.appendChild(buttonGroup);

        leftButton = document.createElement("a");
        leftButton.setAttribute('class','btn btn-outline-primary col-6');
        leftButton.innerHTML = "Generate report"
        buttonGroup.appendChild(leftButton);

        RightButton = document.createElement("a");
        RightButton.setAttribute('class','btn btn-outline-warning col-6');
        RightButton.innerHTML = "Mark as in-stock"
        buttonGroup.appendChild(RightButton);

        productContainer.appendChild(div)
    }
}

function updatePagination(currentPage, numberOfPages){
    paginationContainer = document.getElementById('pagination'); // Get container to put data into
    paginationContainer.innerHTML = ""; // Clear container to remove old pagination
    
    prevDiv = document.createElement("div");
    paginationContainer.appendChild(prevDiv);

    prevFullBtn = document.createElement("a");
    prevFullBtn.innerHTML = "&lsaquo; Previous"
    prevFullBtn.setAttribute('onclick','prevPage()');
    
    prevSmallBtn = document.createElement("a");
    prevSmallBtn.innerHTML = "&lsaquo;"
    prevSmallBtn.setAttribute('onclick','prevPage()');
    
    if (currentPage <= 1){
        prevFullBtn.setAttribute('class','btn btn-outline-success d-none d-sm-block disabled'); 
        prevSmallBtn.setAttribute('class','btn btn-outline-success d-block d-sm-none disabled');
    } else {
        prevFullBtn.setAttribute('class','btn btn-outline-success d-none d-sm-block'); 
        prevSmallBtn.setAttribute('class','btn btn-outline-success d-block d-sm-none');
    }
    prevDiv.appendChild(prevFullBtn);
    prevDiv.appendChild(prevSmallBtn);

    nextDiv = document.createElement("div");
    paginationContainer.appendChild(nextDiv);

    nextFullBtn = document.createElement("a");
    nextFullBtn.innerHTML = "Next &rsaquo;"
    nextFullBtn.setAttribute('onclick','nextPage()');
    
    nextSmallBtn = document.createElement("a");
    nextSmallBtn.innerHTML = "&rsaquo;"
    nextSmallBtn.setAttribute('onclick','nextPage()');
    
    if (currentPage >= numberOfPages){
        nextFullBtn.setAttribute('class','btn btn-outline-success d-none d-sm-block disabled'); 
        nextSmallBtn.setAttribute('class','btn btn-outline-success d-block d-sm-none disabled');
    } else {
        nextFullBtn.setAttribute('class','btn btn-outline-success d-none d-sm-block'); 
        nextSmallBtn.setAttribute('class','btn btn-outline-success d-block d-sm-none');
    }
    nextDiv.appendChild(nextFullBtn);
    nextDiv.appendChild(nextSmallBtn);
}