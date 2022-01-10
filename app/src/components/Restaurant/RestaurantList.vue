<template>
  <div class="restaurant">
    <div class="restaurant-img">
      <img src="~assets/restaurant.png" alt="">
    </div>
    <div class="restaurant-listing">
        <div class="content">
            <h3 class="name">{{ restaurant?.name }} - {{ restaurant?.city }}</h3>
            <p class="info">The best food!</p>
            <!-- <p class="price">Average delivery time </p> -->
            <div class="btn-and-rating-box">
                <div class="rating">

                </div>
                <button class="btn" :disabled="!user.name">View menu</button>
            </div>
        </div>
    </div>
</div>
</template>
<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'RestaurantList',
  components: {  },
  data() {
    return {

    }
  },
  props: {
    restaurant: {
      type: Object
    },
    user: {
      type: Object
    }
  },

});
</script>

<style scoped>

@keyframes slide-in{
  100%{
    opacity: 1;
    left: 50%;
  }
}

.restaurant{
  position: relative;
  width: 1000px;
  min-width: 350px;
  min-height: 500px;
  height: auto;
  display: flex;
  justify-content: center;
  align-items: center;
}

.restaurant-img{
  width: 40%;
  height: 500px;
  background: #fff;
  position: relative;
  opacity: 0;
  transform: translateY(-50px);
  animation: fade-in 1s forwards 1;
}

.restaurant-img img{
  width: 100%;
  height: 100%;
  object-fit: contain;
  user-select: none;
}

.tag{
  position: absolute;
  top: 20px;
  left: -10px;
  transform-origin: left;
  opacity: 0;
  transform: rotate(-90deg);
  text-transform: capitalize;
  color: #eae3d2;
  padding: 5px 10px;
  width: 100px;
  font-size: 18px;
  text-align: center;
  background: #292929;
  user-select: none;
  animation: tag .5s 1s forwards 1;
}

@keyframes tag{
  100%{
    opacity: 1;
    transform: rotate(-20deg);
  }
}

.restaurant-listing{
  width: 60%;
  min-height: 500px;
  height: auto;
  background: #292929;
  padding: 40px;
  display: flex;
  justify-content: center;
  color: #eae3d2;
  opacity: 0;
  transform: translateY(50px);
  animation: fade-in 1s forwards 1;
}

@keyframes fade-in{
  100%{
    opacity: 1;
    transform: translateY(0);
  }
}

.name{
  font-family: 'dosis';
  text-transform: capitalize;
}

.info{
  font-size: 18px;
  line-height: 30px;
  margin: 50px 0;
}

.price{
  font-size: 70px;
  font-weight: 100;
  margin-bottom: 20px;
}

.btn-and-rating-box{
  width: 100%;
  display: flex;
  justify-content: space-between;
}

.rating{
  width: fit-content;
  display: flex;
  justify-content: center;
  align-items: center;
}

.rating img{
  width: 20px;
  height: 20px;
  margin: 0 2px;
}

.btn{
  background: #eae3d2;
  color: #292929;
  border: none;
  text-transform: capitalize;
  font-size: 16px;
  padding: 10px 20px;
  cursor: pointer;
}

.btn:hover{
  background-color: #eedbaf;
}

@media (max-width: 1100px){
  body::before{
    transform: translateX(-50%) skewX(-5deg);
  }
  .restaurant{
    flex-direction: column;
    width: 90%;
    margin: 5vh 0;
  }
  .restaurant-img{
    width: 100%;
    height: 300px;
  }
  .restaurant-listing{
    width: 100%;
    min-height: auto;
  }
  .name,.price{
    font-size: 50px;
  }
  .info{
    font-size: 16px;
  }
}

</style>
