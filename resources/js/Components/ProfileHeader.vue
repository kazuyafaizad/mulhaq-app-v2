 <template>
 <div class="card bg-neutral text-neutral-content">
  <div class="card-body items-center text-center">
 <div class="grid grid-cols-3 items-center justify-evenly md:justify-center gap-1 md:gap-10 ">
            <!-- Profile Photo -->
            <div class="" v-if="user.profile_photo_url">
                <div class="mt-2 ">
                    <img :src="user.profile_photo_url" :alt="user.name" class="mx-auto h-full w-full max-h-[12rem] max-w-[12rem] rounded-full object-cover">
                </div>
            </div>
             <!-- Profile Name -->
            <div class="mb-5 flex flex-col items-center" >
                        <h5 class="text-center">hello</h5>
                        <h1 class="text-xl md:text-2xl capitalize text-center">{{ user.name }}</h1>
            </div>
                <div class="relative">

                    <svg viewBox='0 0 120 100' class="">
                    <path d='M38,2
                            L82,2
                            A12,12 0 0,1 94,10
                            L112,44
                            A12,12 0 0,1 112,56
                            L94,90
                            A12,12 0 0,1 82,98
                            L38,98
                            A12,12 0 0,1 26,90
                            L8,56
                            A12,12 0 0,1 8,44
                            L26,10
                            A12,12 0 0,1 38,2' />
                    </svg>
                    <div class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
                       <small class="text-white">Tier</small>
                    <h2 class="text-3xl capitalize text-center font-semibold text-white">{{ user.tier || 0 }}</h2>
                    </div>
                    </div>


</div>
  </div>
</div>

</template>

<style scoped>
svg {
  transform:rotate(90deg);
}
path {
  stroke: transparent;
  fill: #AB92E1;
}
</style>


<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        props: ['user'],
        components: {
            Link,
        },
    })

</script>
