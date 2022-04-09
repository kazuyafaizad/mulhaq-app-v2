<template>
  <ion-page>
    <ion-content :fullscreen="true">
    <div class="bg-sky">
    <h1 class="big title uppercase">Develop youth to benefit others
      <ion-button color="primary" size="large" href="/tabs/tab1">Login</ion-button>
      <ion-button color="secondary" size="large" href="/tabs/tab3">Register</ion-button> </h1>
    </div>
    </ion-content>
  </ion-page>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import { IonPage, IonHeader, IonToolbar, IonTitle, IonContent,IonButton } from '@ionic/vue';
import ExploreContainer from '@/components/ExploreContainer.vue';

export default  defineComponent({
  name: 'WelcomePage',
  components: { IonContent, IonPage,IonButton }
});
</script>


<style scoped>
.title{
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%);
    font-weight:bold;
    text-shadow: 2px 2px gray;
    text-align:center;
}
.big{
    font-size:4em;
}
.uppercase{
    text-transform: uppercase;
}
ion-content{
    --background:url('/public/assets/img/bg-sky.jpg') no-repeat center/cover;
}
</style>

