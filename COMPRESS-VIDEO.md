# Quick Video Compression Guide

Your current video: **20 MB** → Target: **5-8 MB**

## Method 1: Online Compression (Fastest - No Installation)

### Using FreeConvert.com (Recommended)
1. Visit: https://www.freeconvert.com/video-compressor
2. Upload: `cognigen_assets/lead-4-final.mp4`
3. Settings:
   - Target size: **8 MB**
   - Or set quality: **Medium (CRF 28)**
4. Click "Compress Now"
5. Download compressed file
6. Replace: `cognigen_assets/lead-4-final.mp4`

### Using CloudConvert.com
1. Visit: https://cloudconvert.com/mp4-compress
2. Upload: `cognigen_assets/lead-4-final.mp4`
3. Settings:
   - Codec: H.264
   - Quality: Medium-High
   - Resolution: Keep original
4. Start conversion
5. Download and replace original file

### Using Clideo.com
1. Visit: https://clideo.com/compress-video
2. Upload your video
3. Choose compression level: "Strong"
4. Download compressed file

---

## Method 2: Install FFmpeg (One-time Setup)

### Windows Installation:
1. Download: https://www.gyan.dev/ffmpeg/builds/ffmpeg-release-essentials.zip
2. Extract to: `C:\ffmpeg`
3. Add to PATH:
   - Open System Properties → Environment Variables
   - Edit "Path" → Add: `C:\ffmpeg\bin`
4. Restart terminal

### Then run this command:
```bash
ffmpeg -i cognigen_assets/lead-4-final.mp4 -c:v libx264 -crf 28 -preset medium -c:a aac -b:a 128k cognigen_assets/lead-4-final-compressed.mp4
```

---

## Recommended Compression Settings

| Target Size | Quality | Best For |
|------------|---------|----------|
| 5-6 MB | Good | Fast loading, acceptable quality |
| 7-8 MB | Better | Balance of speed and quality |
| 10-12 MB | High | Best quality, slower loading |

**Recommendation:** Aim for **6-8 MB** for optimal balance.

---

## After Compression:

1. Replace the old video file
2. I will commit and push it for you automatically

---

## Expected Results:
- **Current:** 20 MB = ~15-20 seconds loading on 4G
- **After (8 MB):** ~6-8 seconds loading on 4G
- **After (6 MB):** ~4-5 seconds loading on 4G
