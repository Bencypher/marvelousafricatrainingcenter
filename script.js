document.addEventListener("DOMContentLoaded", () => {
    //carousel

const track = document.querySelector(".track");
const slides = document.querySelectorAll(".slide");
const dots = document.querySelectorAll(".dot");
let current= 0;

const goToSlide = (index) => {
    track.style.transform = `translateX(-${index * 100}%)`;
    dots.forEach(dot => dot.classList.remove("active"));
    dots[index].classList.add("active");
    current = index;
};

setInterval(() => {
    const next = (current + 1) % slides.length;
    goToSlide(next);
}, 3000);

//counter
    const counts = document.querySelectorAll(".count");
counts.forEach(count => {
    const target = +count.dataset.target;
    const suffix = count.dataset.suffix;
    const speed = 200;

    const update = () => {
        const current = +count.innerText;
        const increment = Math.ceil(target / speed);
        
        if (current < target) {
            count.innerText = current + increment;
            setTimeout(update, 10);
        } else {
            count.innerText= target + suffix;
        }

    };
    update();
});
});

// accordion

const faqItems = document.querySelectorAll(".faq-item");

faqItems.forEach(item => {
    const question = item.querySelector(".faq-quest");

    question.addEventListener("click", () => {
        const isActive = item.classList.contains("active");

        // Close all items first
        faqItems.forEach(i => {
            i.classList.remove("active");
            i.querySelector(".faq-anz").style.maxHeight = null;
        });

        // If the clicked one wasn't already open, open it
        if (!isActive) {
            item.classList.add("active");
            const answer = item.querySelector(".faq-anz");
            answer.style.maxHeight = answer.scrollHeight + "px";
        }
    });
});