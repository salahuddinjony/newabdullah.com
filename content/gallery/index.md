---
title: Gallery
layout: gallery
---

<!-- Category Filter Buttons -->
<div class="category-buttons">
  <button onclick="filterImages('all')" id="all-btn" class="active">All</button>
  <button onclick="filterImages('nature')" id="nature-btn">Tech</button>
  <button onclick="filterImages('city')" id="city-btn">City</button>
  <button onclick="filterImages('sunset')" id="sunset-btn">Sunset</button>
</div>

<!-- Gallery Images -->
<div class="gallery-container">
  <div class="gallery-item" data-category="sunset nature">
    <img src="/images/photo2.jpg" alt="Sunset in the mountains" class="gallery-image">
    <p class="image-description">Sunset in the mountains</p>
  </div>
  <div class="gallery-item" data-category="nature city">
    <img src="/images/photo1.jpg" alt="A quiet forest" class="gallery-image">
    <p class="image-description">A quiet forest</p>
  </div>
  <div class="gallery-item" data-category="city">
    <img src="/images/photo3.jpg" alt="City lights at night" class="gallery-image">
    <p class="image-description">City lights at night</p>
  </div>
  <div class="gallery-item" data-category="sunset">
    <img src="/images/photo4.jpg" alt="Golden sunrise" class="gallery-image">
    <p class="image-description">Golden sunrise</p>
  </div>
  <div class="gallery-item" data-category="nature">
    <img src="/images/photo5.jpg" alt="Snowy mountain peak" class="gallery-image">
    <p class="image-description">Snowy mountain peak</p>
  </div>
  <div class="gallery-item" data-category="sunset">
    <img src="/images/photo6.jpg" alt="Desert sunset" class="gallery-image">
    <p class="image-description">Desert sunset</p>
  </div>
</div>

<!-- Modal -->
<div id="imageModal" class="modal" onclick="closeModal(event)">
  <span class="close">&#10006;</span>
  <div class="modal-content-container">
    <img class="modal-content" id="modalImg">
    <div id="caption" class="modal-caption"></div>
  </div>
  <div class="navigation-buttons">
    <button class="prev" onclick="changeImage(-1)">&#10094; Prev</button>
    <button class="next" onclick="changeImage(1)">Next &#10095;</button>
  </div>
</div>

<style>
/* Style for the filter buttons */
.category-buttons {
  text-align: center;
  margin-top: 30px;
}
.category-buttons button {
  margin: 0 10px;
  padding: 12px 30px;
  background-color: #333;
  color: white;
  border: 2px solid transparent;
  border-radius: 25px;
  cursor: pointer;
  font-size: 16px;
  font-weight: 600;
  transition: all 0.3s;
}
.category-buttons button:hover {
  background-color: #555;
  border-color: #fff;
}
.category-buttons button.active {
  background-color: #007BFF;
  border-color: #0056b3;
  box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
}

/* Gallery styles */
.gallery-container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 15px;
  margin-top: 30px;
  padding: 0 10px;
}
@media (max-width: 768px) {
  /* Gallery layout for smaller screens */
  .gallery-container {
    grid-template-columns: repeat(2, 1fr); /* Display 2 items per row */
  }

  /* Category buttons layout for mobile */
  .category-buttons {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
  }

  .category-buttons button {
    width: 45%; /* Two buttons per row */
    margin: 5px;
    font-size: 16px;
    padding: 12px 20px;
    text-align: center;
  }

  /* Navigation buttons layout for mobile */
  .navigation-buttons {
    display: flex;
    justify-content: space-between;
    width: 100%;
    margin-top: 20px;

    /* Add position and adjust bottom */
    position: fixed;
    left: 0;
    bottom: 80px;
    padding: 0 10px;
    z-index: 999; /* Ensure it's above other elements */
  }

  .navigation-buttons button {
    width: 45%;
    font-size: 16px;
    padding: 12px;
  }
}

@media (max-width: 480px) {
  .category-buttons button {
    font-size: 14px;
    padding: 10px 20px;
  }

  .navigation-buttons {
    bottom: 140px !important; /* typo fixed */
  }

  .navigation-buttons button {
    font-size: 14px;
    padding: 10px 15px;
  }
}
/* Gallery item hover effect */
.gallery-item {
  position: relative;
  cursor: pointer;
  border-radius: 15px;
  overflow: hidden;
  box-shadow: 0 6px 20px rgba(0,0,0,0.15);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.gallery-item:hover {
  transform: scale(1.05);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
}
.gallery-item img {
  width: 100%;
  height: auto;
  display: block;
}
.gallery-item p {
  margin: 0;
  text-align: center;
  background: rgba(0, 0, 0, 0.6);
  color: white;
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  font-size: 12px;
  font-weight: 300;
  opacity: 0;
  transition: opacity 0.3s ease;
}
.gallery-item:hover p {
  opacity: 1;
}

/* Modal styles */
.modal {
  display: none;
  position: fixed;
  z-index: 9999;
  top: 0; left: 0;
  width: 100vw;
  height: 100vh;
  background-color: rgba(0,0,0,0.9);
  justify-content: center;
  align-items: center;
  padding: 20px;
}
.modal-content {
  display: block;
  max-width: 95%;
  max-height: 95vh;
  border-radius: 10px;
  transform: scale(0);
  animation: zoomIn 0.4s ease-out forwards;
}
.close {
  position: absolute;
  top: 20px;
  right: 30px;
  font-size: 35px;
  color: white;
  cursor: pointer;
}
#caption {
  text-align: left;
  color: #fff;
  padding: 10px;
  font-size: 16px;
  font-weight: 500;
  background: rgba(0, 0, 0, 0.7);
  position: absolute;
  bottom: 20px;
  left: 20px;
  border-radius: 5px;
  max-width: 80%;
}
.navigation-buttons {
  position: absolute;
  bottom: 40px;
  display: flex;
  justify-content: center;
  width: 100%;
}
button.prev, button.next {
  background-color: rgba(0, 0, 0, 0.5);
  color: white;
  border: none;
  margin: 0 20px;
  padding: 10px 20px;
  cursor: pointer;
  font-size: 18px;
  border-radius: 5px;
  opacity: 0.7;
}
button.prev:hover, button.next:hover {
  opacity: 1;
}

/* Keyframes for the modal zoom-in effect */
@keyframes zoomIn {
  from { transform: scale(0); }
  to { transform: scale(1); }
}
</style>

<script>
// Update category buttons to highlight selected one
function setActiveButton(category) {
  const buttons = document.querySelectorAll('.category-buttons button');
  buttons.forEach(btn => {
    if (btn.id.includes(category)) {
      btn.classList.add('active');
    } else {
      btn.classList.remove('active');
    }
  });
}

// Filter images by category
function filterImages(category) {
  const items = document.querySelectorAll(".gallery-item");
  items.forEach(item => {
    const categories = item.dataset.category.split(" ");
    if (category === "all" || categories.includes(category)) {
      item.style.display = "block";
    } else {
      item.style.display = "none";
    }
  });
  setActiveButton(category);  // Highlight the active category button
}

// Image modal functionality
let currentIndex = 0;
let images = [];

function loadImages() {
  images = [];
  document.querySelectorAll('.gallery-item').forEach((item) => {
    if (item.style.display !== 'none') {
      const img = item.querySelector('img');
      images.push({
        src: img.src,
        alt: img.alt
      });
    }
  });
}

function openModal(el) {
  const modal = document.getElementById("imageModal");
  const modalImg = document.getElementById("modalImg");
  const captionText = document.getElementById("caption");

  loadImages();
  const clickedImage = el.closest('.gallery-item');
  currentIndex = Array.from(document.querySelectorAll('.gallery-item')).filter(i => i.style.display !== 'none').indexOf(clickedImage);

  modal.style.display = "flex";
  modalImg.src = images[currentIndex].src;
  captionText.innerHTML = images[currentIndex].alt;

  document.body.style.overflow = 'hidden';
}

function closeModal(event) {
  const modal = document.getElementById("imageModal");
  if (event.target === modal || event.target.classList.contains('close')) {
    modal.style.display = "none";
    document.body.style.overflow = 'auto';
  }
}

function changeImage(direction) {
  currentIndex = (currentIndex + direction + images.length) % images.length;
  const modalImg = document.getElementById("modalImg");
  const captionText = document.getElementById("caption");

  modalImg.src = images[currentIndex].src;
  captionText.innerHTML = images[currentIndex].alt;
}

document.querySelectorAll('.gallery-item img').forEach(img => {
  img.addEventListener('click', (event) => {
    openModal(event.target);
  });
});

window.addEventListener("keydown", function (e) {
  const modal = document.getElementById("imageModal");
  if (modal.style.display !== "flex") return;

  if (e.key === "Escape") {
    closeModal({ target: modal });
  }
  if (e.key === "ArrowLeft") {
    changeImage(-1);
  }
  if (e.key === "ArrowRight") {
    changeImage(1);
  }
});
window.onload = () => {
  filterImages('all');
};
</script>