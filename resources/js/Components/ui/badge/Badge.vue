<script setup>
import { computed } from "vue";
import { cn } from "@/lib/utils";

const props = defineProps({
    variant: { type: null, required: false },
    class: { type: null, required: false },
    hover: {type: Boolean, default: false}
});

const defaulClasses = "cursor-default inline-flex items-center rounded-md border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none";

// variant setup
const variantClasses = computed(() => {
  const variantMapping = {
    default: "border-transparent bg-primary text-primary-foreground shadow",
    secondary: "border-transparent bg-secondary text-secondary-foreground",
    destructive: "border-transparent bg-destructive text-destructive-foreground shadow",
    outline: "text-foreground"
  }
  if (props.hover) {
    variantMapping.default += " hover:bg-primary-hover"
    variantMapping.secondary += " hover:bg-secondary-hover"
    variantMapping.destructive += " hover:bg-destructive-hover"
    variantMapping.outline += " hover:bg-opacity-10"
  }
  return variantMapping[props.variant] || variantMapping.default
})

</script>

<template>
    <div :class="cn([defaulClasses, variantClasses], props.class)">
        <slot />
    </div>
</template>
