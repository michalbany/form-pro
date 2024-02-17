<script setup>
import { defineProps } from "vue";

const props = defineProps({
    color: {
        type: String,
        default: "blue",
    },
});
</script>

<template>
    <svg
        v-if="!props.color || props.color === 'blue'"
        xmlns="http://www.w3.org/2000/svg"
        id="Vrstva_2"
        viewBox="0 0 103.5 103.5"
    >
        <g id="Vrstva_1-2">
            <path
                d="M0,0h69v59c0,5.52-4.48,10-10,10H0V0H0Z"
                transform="translate(69 69) rotate(180)"
                style="fill: #3b82f6; stroke-width: 0px"
            />
            <polygon
                points="69 0 69 69 0 69 69 0"
                style="fill: #1e40af; stroke-width: 0px"
            />
            <path
                d="M44.5,34.5h59v69H34.5v-59c0-5.52,4.48-10,10-10Z"
                transform="translate(138 138) rotate(180)"
                style="fill: #3b82f6; stroke-width: 0px"
            />
            <polyline
                points="69 34.5 34.5 34.5 69 0 69 34.5"
                style="fill: #60a5fa; stroke-width: 0px"
            />
            <path
                d="M103.5,34.5v59c0,5.52-4.48,10-10,10h-59S103.5,34.5,103.5,34.5Z"
                style="fill: #1d4ed8; stroke-width: 0px"
            />
        </g>
    </svg>

    <svg
        v-else-if="props.color === 'white'"
        xmlns="http://www.w3.org/2000/svg"
        id="Vrstva_2"
        viewBox="0 0 103.5 103.5"
    >
        <g id="Vrstva_1-2">
            <path
                d="M0,0h69v59c0,5.52-4.48,10-10,10H0V0H0Z"
                transform="translate(69 69) rotate(180)"
                style="fill: #fff; stroke-width: 0px"
            />
            <polygon
                points="69 0 69 69 0 69 69 0"
                style="fill: #cecece; stroke-width: 0px"
            />
            <path
                d="M44.5,34.5h59v69H34.5v-59c0-5.52,4.48-10,10-10Z"
                transform="translate(138 138) rotate(180)"
                style="fill: #fff; stroke-width: 0px"
            />
            <polyline
                points="69 34.5 34.5 34.5 69 0 69 34.5"
                style="fill: #f4f4f4; stroke-width: 0px"
            />
            <path
                d="M103.5,34.5v59c0,5.52-4.48,10-10,10h-59S103.5,34.5,103.5,34.5Z"
                style="fill: #e5e5e5; stroke-width: 0px"
            />
        </g>
    </svg>

    <svg
        v-else-if="props.color === 'stroke'"
        xmlns="http://www.w3.org/2000/svg"
        id="Vrstva_2"
        viewBox="0 0 105 105"
    >
        <g id="Vrstva_1-2">
            <path
                d="M1.5,1.5h69v59c0,5.52-4.48,10-10,10H1.5V1.5h0Z"
                transform="translate(72 72) rotate(180)"
                style="
                    fill: none;
                    stroke: #fff;
                    stroke-miterlimit: 10;
                    stroke-width: 3px;
                "
            />
            <polygon
                points="70.5 1.5 70.5 70.5 1.5 70.5 70.5 1.5"
                style="
                    fill: none;
                    stroke: #fff;
                    stroke-linejoin: bevel;
                    stroke-width: 3px;
                "
            />
            <path
                d="M102,39v56c0,3.86-3.14,7-7,7h-56v-63h63M105,36H36v69h59c5.52,0,10-4.48,10-10v-59h0Z"
                style="fill: #fff; stroke-width: 0px"
            />
            <polyline
                points="70.5 36 36 36 70.5 1.5 70.5 36"
                style="
                    fill: none;
                    stroke: #fff;
                    stroke-linejoin: bevel;
                    stroke-width: 3px;
                "
            />
            <path
                d="M102,43.24v51.76c0,3.86-3.14,7-7,7h-51.76s58.76-58.76,58.76-58.76M105,36L36,105h59c5.52,0,10-4.48,10-10v-59h0Z"
                style="fill: #fff; stroke-width: 0px"
            />
        </g>
    </svg>
</template>
