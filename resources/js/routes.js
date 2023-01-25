let login = require('./components/auth/login.vue').default;
let register = require('./components/auth/register.vue').default;
let forget = require('./components/auth/forget.vue').default;
let logout = require('./components/auth/logout.vue').default;
//End Authentication

let home = require('./components/home.vue').default;

//Employee
let store_employee = require('./components/employee/create.vue').default;
let employee = require('./components/employee/index.vue').default;
let editemployee = require('./components/employee/edit.vue').default;
//Customer
let store_customer = require('./components/customer/create.vue').default;
let customer = require('./components/customer/index.vue').default;
let editcustomer = require('./components/customer/edit.vue').default;

//supplier
let store_supplier = require('./components/supplier/create.vue').default;
let supplier = require('./components/supplier/index.vue').default;
let editsupplier = require('./components/supplier/edit.vue').default;

//category
let store_category = require('./components/category/create.vue').default;
let category = require('./components/category/index.vue').default;
let editcategory = require('./components/category/edit.vue').default;
//product
let store_product = require('./components/product/create.vue').default;
let product = require('./components/product/index.vue').default;
let editproduct = require('./components/product/edit.vue').default;
//expense
let store_expense = require('./components/expense/create.vue').default;
let expense = require('./components/expense/index.vue').default;
let editexpense = require('./components/expense/edit.vue').default;
//salary
let salary = require('./components/salary/all_employee.vue').default;
let pay_salary = require('./components/salary/create.vue').default;
let all_salary = require('./components/salary/index.vue').default;
let view_salary = require('./components/salary/view.vue').default;
let edit_salary = require('./components/salary/edit.vue').default;

//allowance
let allowance = require('./components/allowance/index.vue').default;
let add_allowance = require('./components/allowance/create.vue').default;
let view_allowance = require('./components/allowance/view.vue').default;
let add_allowance_member = require('./components/allowance/add_member.vue').default;
let edit_allowance = require('./components/allowance/edit.vue').default;
//deduction
let deduction = require('./components/deduction/index.vue').default;
let add_deduction = require('./components/deduction/create.vue').default;
let view_deduction = require('./components/deduction/view.vue').default;


//stock
let stock = require('./components/product/all_stock.vue').default;
let edit_stock = require('./components/product/edit_stock.vue').default;
//pos
let pos = require('./components/pos/pointofsale.vue').default;
//order
let order = require('./components/order/order.vue').default;
let view_order = require('./components/order/view_order.vue').default;
let order_search = require('./components/order/order_search.vue').default;

export const routes =[
    {path:'/', component:login, name:'/'},
    {path:'/register', component:register, name:'register'},
    {path:'/forget', component:forget, name:'forget'},
    {path:'/logout', component:logout, name:'logout'},

    {path:'/home', component:home, name:'home'},

    //employee routes
    {path:'/store_employee', component:store_employee, name:'store_employee'},
    {path:'/employee', component:employee, name:'employee'},
    {path:'/edit_employee/:id', component:editemployee, name:'edit_employee'},

    //supplier routes
    {path:'/store_supplier', component:store_supplier, name:'store_supplier'},
    {path:'/supplier', component:supplier, name:'supplier'},
    {path:'/edit_supplier/:id', component:editsupplier, name:'edit_supplier'},

    //categoryroutes
    {path:'/store_category', component:store_category, name:'store_category'},
    {path:'/category', component:category, name:'category'},
    {path:'/edit_category/:id', component:editcategory, name:'edit_category'},
    //productroutes
    {path:'/store_product', component:store_product, name:'store_product'},
    {path:'/product', component:product, name:'product'},
    {path:'/edit_product/:id', component:editproduct, name:'edit_product'},
    //expenseroutes
    {path:'/store_expense', component:store_expense, name:'store_expense'},
    {path:'/expense', component:expense, name:'expense'},
    {path:'/edit_expense/:id', component:editexpense, name:'edit_expense'},
    //salaryroutes
    {path:'/issue_salary', component:salary, name:'issue_salary'},
    {path:'/pay_salary/:id', component:pay_salary, name:'pay_salary'},
    {path:'/salary', component:all_salary, name:'salary'},
    {path:'/view_salary/:id', component:view_salary, name:'view_salary'},
    {path:'/edit_salary/:id', component:edit_salary, name:'edit_salary'},
    //allowance routes
    {path:'/add_allowance', component:add_allowance, name:'add_allowance'},
    {path:'/allowance', component:allowance, name:'allowance'},
    {path:'/view_allowance/:id', component:view_allowance, name:'view_allowance'},
    {path:'/add_allowance_member/:id', component:add_allowance_member, name:'add_allowance_member'},
    {path:'/edit_allowance/:id', component:edit_allowance, name:'edit_allowance'},
    //deduction routes
    {path:'/add_deduction', component:add_deduction, name:'add_deduction'},
    {path:'/deduction', component:deduction, name:'deduction'},
    {path:'/view_deduction/:id', component:view_deduction, name:'view_deduction'},
  

    //stockroutes
    {path:'/stock', component:stock, name:'stock'},
    {path:'/edit_stock/:id', component:edit_stock, name:'edit_stock'},
    //customer routes
    {path:'/store_customer', component:store_customer, name:'store_customer'},
    {path:'/customer', component:customer, name:'customer'},
    {path:'/edit_customer/:id', component:editcustomer, name:'edit_customer'},

    //pos routes
    {path:'/pos', component:pos, name:'pos'},
    //order routes
    {path:'/order', component:order, name:'order'},
    {path:'/view_order/:id', component:view_order, name:'view_order'},
    {path:'/order_search', component:order_search, name:'order_search'},
]