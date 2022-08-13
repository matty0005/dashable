<template>
    <div>

    <div id="overlay" style="position: absolute; top: auto; left: auto; z-index: 0; padding: 0px; margin: 0px; background-color: transparent; display: block; width: 512px; height: 557px;" v-bind:style="{ 'background-image': 'url(' + backgroundLegend + ')' }">
    <img name="animation" id="animation" class="animation" :src="backgroundRadar" alt="Radar images" width="512" height="512" border="0">
    <div id="backgroundDiv" style="width: 512px; height: 512px; background-color: transparent; position: absolute; z-index: -3; left: 0px; top: 0px;" v-bind:style="{ 'background-image': 'url(' + backgroundImage + ')' }"></div>
    <div id="locationsDiv" style="width: 512px; height: 512px; background-color: transparent; position: absolute; z-index: 7; left: 0px; top: 0px;" v-bind:style="{ 'background-image': 'url(' + backgroundLocation + ')' }"></div>
    <div id="rangeDiv" style="width: 512px; height: 512px; background-color: transparent; position: absolute; z-index: 2; left: 0px; top: 0px;" v-bind:style="{ 'background-image': 'url(' + backgroundRange + ')' }"></div>
    <div id="topographyDiv" style="width: 512px; height: 512px; background-color: transparent; position: absolute; z-index: -2; left: 0px; top: 0px;" v-bind:style="{ 'background-image': 'url(' + backgroundTopography + ')' }"></div></div>
            
</div>
</template>

<script>
export default {
    mounted() {
       
        let _t = this
        setInterval(() => {
            _t.setImage()
        }, 750);
    },
    methods: {
        setImage() {
            // Save current index, and show the last index twice
            var index = this.imageIndex

            if (index == this.images.length) {
                index--;
            }

            this.backgroundRadar = this.images[index];

            this.imageIndex++
            
            if (this.imageIndex > this.images.length) {
                this.imageIndex = 0;
            }
        }
    },
    props:{
        images: Array
    },
    data: () => {
        return {
            backgroundRadar: 'http://www.bom.gov.au/radar/IDR664.T.202208131139.png',
            backgroundLegend: 'http://www.bom.gov.au/products/radar_transparencies/IDR.legend.0.png',
            backgroundImage: 'http://www.bom.gov.au/products/radar_transparencies/IDR664.background.png',
            backgroundLocation: 'http://www.bom.gov.au/products/radar_transparencies/IDR664.locations.png',
            backgroundRange: 'http://www.bom.gov.au/products/radar_transparencies/IDR664.range.png',
            backgroundTopography: 'http://www.bom.gov.au/products/radar_transparencies/IDR664.topography.png',
            imageIndex: 0
        }
    }
}
</script>