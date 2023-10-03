const main = document.querySelector("main");

const moneyCountDisplay = document.querySelector(".money_count");
const workButton = document.querySelector(".work_btn");
const upgradeWorkButton = document.querySelector(".upgrade_work_btn");
const upgradeWorkCostDisplay = document.querySelector(".workCost");
const employeeCostDisplay = document.querySelector(".employeeCost");
const hireEmployeeButton = document.querySelector(".hire_employee_btn");

// Display profits
const workProfitSpan = document.querySelector(".work_profit");
const employeeProfitSpan = document.querySelector(".employee_profit");

const animations = ["wiggle", "flyaway", "spin"];

let money = parseInt(localStorage.getItem("money")) || 0;
let workProfit = parseInt(localStorage.getItem("workProfit")) || 1;
let upgradeWorkCost = parseInt(localStorage.getItem("upgradeWorkCost")) || 20;
let employeeCost = parseInt(localStorage.getItem("employeeCost")) || 20;
let employeeProfit = parseInt(localStorage.getItem("employeeProfit")) || 0;


const generateMoney = (amount, miliSec) => {
setInterval(() => {
money += amount
}, miliSec);
}

const hireEmployee = () => {
if (money >= employeeCost) {
money -= employeeCost;
employeeProfit += 3;
employeeCost = Math.ceil(employeeCost * 1.6);
generateMoney(employeeProfit, 3000);
};
}

const upgradeWork = () => {
if (money >= upgradeWorkCost) {
money -= upgradeWorkCost;
upgradeWorkCost = Math.ceil(upgradeWorkCost * 2);
workProfit = Math.ceil(workProfit * 2);
}
}

workButton.addEventListener("click", () => {
money += workProfit;

const moneyCoin = document.createElement("img");

moneyCoin.src = "/images/moneyCoin.webp";
main.appendChild(moneyCoin);
moneyCoin.classList.add(animations[Math.floor(Math.random() * animations.length)]);
moneyCoin.classList.add("coin_properties");

setTimeout(() => main.removeChild(moneyCoin), 1000);
saveMoney();
})

hireEmployeeButton.addEventListener("click", () => {
hireEmployee();
saveMoney();
});

upgradeWorkButton.addEventListener("click", () => {
upgradeWork();
saveMoney();
})

// Display total amount of money
const updateDisplay = () => {
moneyCountDisplay.textContent = money;
employeeCostDisplay.textContent = employeeCost;
upgradeWorkCostDisplay.textContent = upgradeWorkCost;
workProfitSpan.textContent = workProfit;
employeeProfitSpan.textContent = employeeProfit;
requestAnimationFrame(updateDisplay);
}

const saveMoney = () => {
localStorage.setItem("money", money);
localStorage.setItem("workProfit", workProfit);
localStorage.setItem("upgradeWorkCost", upgradeWorkCost);
}

const retrieveMoney = () => {
money = parseInt(localStorage.getItem("money")) || 0;
}

const saveUpgradeCosts = () => {
localStorage.setItem("employeeCost", employeeCost);
localStorage.setItem("employeeProfit", employeeProfit);
}

const retrieveUpgradeCosts = () => {
employeeCost = parseInt(localStorage.getItem("employeeCost")) || 20;
employeeProfit = parseInt(localStorage.getItem("employeeProfit")) || 0;
}

hireEmployeeButton.addEventListener("click", () => {
hireEmployee();
saveMoney();
saveUpgradeCosts();
});

upgradeWorkButton.addEventListener("click", () => {
upgradeWork();
saveMoney();
saveUpgradeCosts();
});

updateDisplay();
retrieveMoney();
retrieveUpgradeCosts();