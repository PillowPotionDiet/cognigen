# Video Compression Guide

## Current Situation
- **Current video size:** 135 MB
- **Load time:** Very slow (10-30+ seconds depending on connection)
- **Recommended size:** 20-40 MB for optimal web performance

## Why Compress?

A 135MB video is too large for web delivery. Compressing it will:
- ✅ Load 3-5x faster
- ✅ Use less bandwidth (saves hosting costs)
- ✅ Better user experience
- ✅ Works on mobile devices with slower connections
- ✅ Reduces bounce rate (users won't leave while waiting)

## Compression Options

### Option 1: HandBrake (Free, Best Quality)

**Download:** https://handbrake.fr/

**Steps:**
1. Install and open HandBrake
2. Click "Open Source" → Select your video
3. **Preset:** Select "Web" → "Gmail Large 3 Minutes 720p30"
4. **Settings to adjust:**
   - Video Codec: H.264
   - Quality: RF 23-25 (lower number = better quality but larger file)
   - Frame Rate: 30 FPS
   - Resolution: 1280x720 (720p) or 1920x1080 (1080p if needed)
5. Click "Start Encode"
6. **Target:** Get file size under 40MB

**Quality Tips:**
- RF 23 = High quality (~40-50MB)
- RF 25 = Good quality (~30-40MB)
- RF 27 = Acceptable quality (~20-30MB)

---

### Option 2: FFmpeg (Command Line, Most Control)

**Install FFmpeg:** https://ffmpeg.org/download.html

**Command for good compression:**
```bash
ffmpeg -i lead-4-final.mp4 -c:v libx264 -crf 25 -preset slow -c:a aac -b:a 128k -movflags +faststart lead-4-compressed.mp4
```

**Explanation:**
- `-crf 25` = Quality level (23-28 recommended)
- `-preset slow` = Better compression (takes longer)
- `-b:a 128k` = Audio bitrate
- `-movflags +faststart` = Optimizes for web streaming

**To reduce size further:**
```bash
ffmpeg -i lead-4-final.mp4 -c:v libx264 -crf 27 -vf scale=1280:720 -preset slow -c:a aac -b:a 96k -movflags +faststart lead-4-compressed.mp4
```

---

### Option 3: Online Tools (Quick & Easy)

**CloudConvert (Free, 25 conversions/day):**
- https://cloudconvert.com/mp4-converter
- Upload video → Select MP4
- Adjust quality slider to reduce size
- Download compressed video

**FreeConvert (Free):**
- https://www.freeconvert.com/video-compressor
- Target size: 30-40 MB
- Choose quality level
- Download

**Clideo (Free with watermark):**
- https://clideo.com/compress-video
- Automatic compression
- Download (may have watermark)

---

## Recommended Settings for Web

| Setting | Recommended Value |
|---------|------------------|
| **Resolution** | 1280x720 (720p) |
| **Frame Rate** | 30 FPS |
| **Video Codec** | H.264 |
| **Audio Codec** | AAC |
| **Target Bitrate** | 1.5-2.5 Mbps |
| **Audio Bitrate** | 96-128 kbps |
| **File Size Goal** | 20-40 MB |

---

## After Compression

1. **Test the video** - Make sure quality is acceptable
2. **Rename** to `lead-4-final.mp4` (same name)
3. **Replace files** in these locations:
   - `cognigen_assets/lead-4-final.mp4`
   - `ds/cognigen_assets/lead-4-final.mp4`
4. **Upload to hosting** via FTP (replace old files)
5. **Test loading speed** - Should be much faster!

---

## Expected Results

| File Size | Estimated Load Time | Quality |
|-----------|-------------------|---------|
| 135 MB (current) | 10-30 seconds | Excellent |
| 40 MB | 3-8 seconds | Very Good |
| 30 MB | 2-6 seconds | Good |
| 20 MB | 1-4 seconds | Acceptable |

**Recommendation:** Aim for 30-40MB to balance quality and speed.

---

## Alternative: Multiple Quality Versions

Create multiple versions and let users choose:
- **High Quality:** 720p, 40MB
- **Standard Quality:** 480p, 20MB
- **Low Quality:** 360p, 10MB

This requires additional JavaScript to implement quality switching.

---

## Need Help?

If you need help compressing the video, let me know and I can provide more specific guidance based on your preferred method!
