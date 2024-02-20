// Not Empty: true


const getProduct = async () => {
    const response = await fetch('/my-little-mvc/admin/products');
    const data = await response.json();
    console.log(data);
    return data;
}

getProduct()
