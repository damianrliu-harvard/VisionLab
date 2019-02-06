//progressbar.js

function initProgressBar() {
  return new ProgressBar.Line('#barBox', {
    strokeWidth: 4,
    easing: 'easeInOut',
    duration: 250,
    color: '#6400F9',
    trailColor: '#eee',
    trailWidth: 1,
    svgStyle: {width: '100%', height: '100%'},
    text: {
      style: {
        // Text color. Default: same as stroke color (options.color)
        color: '#999',
        position: 'absolute',
        right: '0',
        top: '20px',
        padding: 0,
        margin: 0,
        transform: null
      },
      autoStyleContainer: false
    },
    from: {color: '#6400F9'},
    to: {color: '#45AFD0'},
    step: (state, bar) => {
      bar.path.setAttribute('stroke', state.color);
      bar.setText(Math.round(bar.value() * 100) + ' % of Assets Loaded');
    }
  });
}
