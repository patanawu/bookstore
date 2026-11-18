<style>
    .music-player {
        position: fixed;
        right: 25px;
        bottom: 25px;
        z-index: 99999;
    }

    .music-play-button {
        position: relative;
        width: 62px;
        height: 62px;
        border-radius: 50%;
        border: 2px solid #ff3030;
        background: radial-gradient(circle at 35% 30%, #292929, #080808 75%);
        color: #ff3838;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow:
            0 0 0 5px rgba(255, 35, 35, .08),
            0 0 18px rgba(255, 30, 30, .35),
            inset 0 0 12px rgba(255, 30, 30, .12);
        transition: transform .25s ease, box-shadow .25s ease;
    }

    .music-play-button:hover {
        transform: scale(1.1);
        box-shadow:
            0 0 0 7px rgba(255, 35, 35, .12),
            0 0 28px rgba(255, 30, 30, .65);
    }

    .music-play-button:active {
        transform: scale(.94);
    }

    .music-play-button svg {
        width: 23px;
        height: 23px;
        fill: currentColor;
        filter: drop-shadow(0 0 5px rgba(255, 40, 40, .65));
    }

    .music-play-button.is-playing {
        animation: musicGlow 2s infinite ease-in-out;
    }

    .music-play-button.is-playing::before {
        content: "";
        position: absolute;
        inset: -7px;
        border: 1px solid rgba(255, 48, 48, .5);
        border-radius: 50%;
        animation: musicPulse 1.8s infinite;
    }

    .music-play-button .music-bars {
        display: none;
        align-items: center;
        gap: 3px;
        height: 22px;
    }

    .music-play-button.is-playing .music-bars {
        display: flex;
    }

    .music-bars span {
        width: 3px;
        height: 8px;
        border-radius: 5px;
        background: #ff3838;
        animation: musicBars .65s infinite alternate ease-in-out;
    }

    .music-bars span:nth-child(2) { animation-delay: .2s; }
    .music-bars span:nth-child(3) { animation-delay: .4s; }

    .music-play-button.is-playing .play-icon {
        display: none;
    }

    @keyframes musicGlow {
        50% { box-shadow: 0 0 28px rgba(255, 30, 30, .65); }
    }

    @keyframes musicPulse {
        0% { transform: scale(.94); opacity: .8; }
        100% { transform: scale(1.3); opacity: 0; }
    }

    @keyframes musicBars {
        from { height: 5px; }
        to { height: 21px; }
    }

    @media(max-width: 480px) {
        .music-player {
            right: 17px;
            bottom: 17px;
        }

        .music-play-button {
            width: 56px;
            height: 56px;
        }
    }
</style>

<div id="persistentMusicPlayer" class="music-player" data-turbo-permanent>
    <audio id="bookstoreAudio"
        src="{{ asset('storage/music/beneath-the-mask-persona-5-128-ytshorts.savetube.me.mp3') }}"
        loop preload="none">
    </audio>

    <button type="button"
        class="music-play-button"
        id="musicPlayButton"
        aria-label="Play music"
        title="Play Music">

        <svg class="play-icon" viewBox="0 0 24 24">
            <path d="M8 5v14l11-7z"/>
        </svg>

        <span class="music-bars">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </button>
</div>

<script>
(() => {
    const audio = document.getElementById('bookstoreAudio');
    const button = document.getElementById('musicPlayButton');

    if (!audio || !button || button.dataset.musicInitialized === 'true') return;
    button.dataset.musicInitialized = 'true';

    button.addEventListener('click', async () => {
        if (audio.paused) {
            try {
                await audio.play();
                button.classList.add('is-playing');
                button.setAttribute('aria-label', 'Pause music');
                button.title = 'Pause Music';
            } catch (error) {
                console.error('Musik gagal diputar:', error);
            }
        } else {
            audio.pause();
            button.classList.remove('is-playing');
            button.setAttribute('aria-label', 'Play music');
            button.title = 'Play Music';
        }
    });

    audio.addEventListener('ended', () => {
        button.classList.remove('is-playing');
    });
})();
</script>

