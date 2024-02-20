// Not Empty: true

const getProduct = async () => {
  const response = await fetch("/my-little-mvc/admin/products");
  const data = await response.json();
  return data;
};


const getUsers = async () => {
  const response = await fetch("/my-little-mvc/admin/users");
  const data = await response.json();
  return data;
};

getUsers().then((data) => {
  console.log(data);
});


getProduct().then((data) => {
  console.log(data);
});
