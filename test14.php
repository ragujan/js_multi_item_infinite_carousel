<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="output.css">
    <title>Document</title>
    <style>
 

        .fakeClass {}
    </style>
</head>

<body>


    <div id="carouselContainer" class="w-[1200px] overflow-scroll">
        <div id="carousel" class="flex w-full bg-green-500 ">


            <?php
            for ($i = 0; $i < 10; $i++) {
            ?>
                <div class="fakeClass flex-shrink-0  border-2 border-red-500  p-3 w-[100%] md:w-[33.3%] lg:w-[25%] h-32 bg-gray-300 ">

                    Item <?= $i + 1 ?>

                </div>
            <?php
            }
            ?>
            <!-- Add more items as needed -->
        </div>
    </div>

    <button id="prev" class="p-2 mt-3 bg-yellow-400">prev</button>
    <button id="next" class="p-2 mt-3 bg-yellow-400">next</button>

    <script>
        const nextButton = document.getElementById('next');
        // it does nothing for now
        const prevButton = document.getElementById('prev');
        const transitionDuration = 700;

        // this is the carousel 
        const carousel = document.getElementById('carousel');
        // total carousel width if its 3000 because I added 10 300px images 
        const carouselWidth = Math.round(carousel.getBoundingClientRect().width);
        // this is the first slide 
        let firstSlide = carousel.getElementsByClassName('fakeClass')[0];
        // all the slides
        const slides = carousel.getElementsByClassName('fakeClass');
        // first slides length, I any slides length 
        let firstSlideLength = Math.round(firstSlide.getBoundingClientRect().width);
        // every slides length, if 10 slides with 300px width, then its 3000px
        const slideTotalLength = Math.round(slides.length * firstSlideLength);
        // how many slides you want to show 
        let slidesPerView = Math.round(carouselWidth / firstSlideLength)
        // we don't need countgap any more, just ignore it
        let countGap = slides.length;

        let currentIndex = 0;
        nextButton.addEventListener('click', () => {
            nextButton.disabled = true;
            carousel.style.transition = `margin ${transitionDuration}ms`

            const sliderPositionLeft = Math.round(carousel.getBoundingClientRect().left);
            const translationAmount = sliderPositionLeft - firstSlideLength;


            console.log("slides per view is ", slidesPerView)
            console.log("total slider length ", slideTotalLength)
            console.log("slide length ", firstSlideLength)
            console.log("translation amount ", translationAmount)
            // ignore this we don't need this anymore
            countGap = slides.length - currentIndex;


            carousel.style.marginLeft = `${translationAmount}px`



            currentIndex++;
            console.log("slide length ", slides.length)
            console.log("current index is ", currentIndex)
            // this is to prevent multiple quick clickings of the next button
            setTimeout(() => {
                nextButton.disabled = false;
            }, transitionDuration + 50)

        })

        const removeSlides = (elementSize) => {
            const parentElement = carousel;
            const childElements = parentElement.children;

            for (let i = 0; i < elementSize; i++) {

                if (childElements[0]) {
                    parentElement.removeChild(childElements[0]);
                }

            }
        }
        const addSlides = (elementSize) => {
            const parentElement = carousel;

            for (let i = 0; i < elementSize; i++) {

                parentElement.appendChild(slides[i].cloneNode(true));

            }
        }
        carousel.addEventListener('transitionend', () => {

            if (currentIndex === slidesPerView + 1) {
                // if (countGap === slidesPerView + 1) {
                console.log("we are going to stop")
                addSlides(slides.length);

            }
            if (currentIndex === 10) {
                console.log("this is where everything resets ")
                carousel.style.transition = `none`
                console.log("current index is ", currentIndex)
                removeSlides(currentIndex)

                carousel.style.marginLeft = `${0}px`
                currentIndex = 0;
            }
        })
    </script>
</body>

</html>