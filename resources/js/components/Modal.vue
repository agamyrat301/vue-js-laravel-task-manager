<template>
    <transition name="modal-fade">
        <div class="modal-overlay fixed left-0 top-0 z-[1055] h-full w-full overflow-y-auto overflow-x-hidden outline-none"
            @click="closeModal" v-show="props.modalActive">
            <div class="relative w-[500px] translate-y-[-50px] transition-all 
        duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 transform-none opacity-100 
        h-[calc(100%-4rem)]">
                <div
                    class="pointer-events-auto relative flex max-h-[100%] w-full flex-col h-full overflow-hidden rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-neutral-600">
                    <!--MODAL HEADER-->
                    <div
                        class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                        <h5 class="text-xl font-medium leading-normal text-neutral-800 dark:text-neutral-200">
                            {{ props.modalHeader }}
                        </h5>
                        <button @click="closeEmit('close')" type="button"
                            class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
                            data-te-modal-dismiss="" aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>

                        </button>
                    </div>

                    <!--MODAL HEADER-->
                    <slot />
                </div>
            </div>
        </div>
    </transition>

</template>

<script setup>
const closeEmit = defineEmits(["close"]);

const props = defineProps({
  modalActive: {
    type: Boolean,
    required: true,
  },
  modalHeader: {
    type: String,
    required: false,
  },
  isMap: {
    type: Boolean,
    required: false,
  },
  isAdmin: {
    type: Boolean,
    required: false,
  },
  customLat: {
    type: String,
    required: false,
  },
  customLng: {
    type: String,
    required: false,
  },
});
</script>


<style scoped>

.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}

.modal-container {
  max-width: 50%;
  max-height: 50%;
  background-color: white;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
}

.modal-fade-enter-active,
.modal-fade-leave-active {
  transition: opacity 0.5s;
}

.modal-fade-enter,
.modal-fade-leave-to {
  opacity: 0;
}

</style>
