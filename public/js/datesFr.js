function getDateFromTimestamp(timeStamp) {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    const userLocale = globalThis.navigator.language;
    const date = new Date(timeStamp * 1000);
    return date.toLocaleDateString(userLocale, options);
};
  
const dates = document.querySelectorAll('[data-date]');

dates.forEach(function (dateElement) {
    console.log(dateElement.dataset.date);

    dateElement.innerText = getDateFromTimestamp(dateElement.dataset.date);
});