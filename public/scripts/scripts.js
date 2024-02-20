// Not Empty: true

const getProduct = async () => {
  const response = await fetch("/my-little-mvc/admin/products");
  const data = await response.json();
  return data;
};

getProduct().then((data) => {
  console.log(data);
});
