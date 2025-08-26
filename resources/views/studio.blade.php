{{-- resources/views/studio.blade.php
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Studio Lab - MicroLab Virtual</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-gray-800 flex items-center justify-center h-screen">
    <div class="text-center">
        <h1 class="text-5xl font-bold text-white">Selamat Datang di Lab Virtual!</h1>
        <p class="text-xl text-gray-300 mt-4">Simulasi untuk teknik <span class="font-semibold text-yellow-400">Teknik</span> akan muncul di sini.</p>
        <a href="/" class="mt-8 inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition">
            Kembali ke Detail Bakteri
        </a>
    </div>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MicroLab Studio</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen relative select-none overflow-hidden">
    <!-- Area atas (meja hijau) -->
    <div class="absolute top-0 left-0 w-full h-[85%] bg-gradient-to-b from-green-100 to-green-200"></div>
    
    <!-- Object 1 -->
    <div id="object1" class="draggable-object absolute z-20 px-4 py-3 bg-black rounded-lg shadow-lg w-36 text-center cursor-move transition-shadow hover:shadow-xl">
        <div class="text-white text-sm font-medium">Klik di sini untuk drag</div>
        <p class="text-white text-xs mt-1">Object 1</p>
    </div>
    
    <!-- Object 2 -->
    <div id="object2" class="draggable-object absolute z-20 px-4 py-3 bg-blue-600 rounded-lg shadow-lg w-36 text-center cursor-move transition-shadow hover:shadow-xl">
        <div class="text-white text-sm font-medium">Klik di sini untuk drag</div>
        <p class="text-white text-xs mt-1">Object 2</p>
    </div>
    
    <!-- Meja kuning (area bawah) -->
    <div class="absolute bottom-0 left-0 w-full h-[15%] bg-gradient-to-t from-yellow-500 to-yellow-400 border-t-4 border-yellow-600"></div>

    <script>
        class DragDropSystem {
            constructor() {
                this.objects = [];
                this.dragging = null;
                this.tableHeight = window.innerHeight * 0.15; // 15% untuk meja kuning
                this.workAreaHeight = window.innerHeight * 0.85; // 85% untuk area kerja
                this.gravity = 0.8;
                this.animationId = null;
                
                this.init();
            }
            
            init() {
                // Setup objects
                const object1 = document.getElementById('object1');
                const object2 = document.getElementById('object2');
                
                // Initialize positions
                this.setupObject(object1, 50, 100);
                this.setupObject(object2, 220, 150);
                
                // Start physics loop
                this.startPhysics();
            }
            
            setupObject(element, x, y) {
                const objData = {
                    element: element,
                    x: x,
                    y: y,
                    velocityY: 0,
                    isDragging: false,
                    width: element.offsetWidth,
                    height: element.offsetHeight
                };
                
                this.objects.push(objData);
                this.updateObjectPosition(objData);
                this.makeObjectDraggable(objData);
            }
            
            updateObjectPosition(objData) {
                objData.element.style.left = objData.x + 'px';
                objData.element.style.top = objData.y + 'px';
            }
            
            makeObjectDraggable(objData) {
                let startX, startY, initialMouseX, initialMouseY;
                
                objData.element.addEventListener('mousedown', (e) => {
                    e.preventDefault();
                    objData.isDragging = true;
                    this.dragging = objData;
                    
                    // Bring to front
                    objData.element.style.zIndex = '30';
                    
                    startX = objData.x;
                    startY = objData.y;
                    initialMouseX = e.clientX;
                    initialMouseY = e.clientY;
                    
                    objData.element.style.cursor = 'grabbing';
                    
                    const onMouseMove = (e) => {
                        if (!objData.isDragging) return;
                        
                        const deltaX = e.clientX - initialMouseX;
                        const deltaY = e.clientY - initialMouseY;
                        
                        objData.x = startX + deltaX;
                        objData.y = startY + deltaY;
                        
                        // Constrain to bounds
                        objData.x = Math.max(0, Math.min(window.innerWidth - objData.width, objData.x));
                        objData.y = Math.max(0, Math.min(this.workAreaHeight - objData.height, objData.y));
                        
                        this.updateObjectPosition(objData);
                    };
                    
                    const onMouseUp = () => {
                        objData.isDragging = false;
                        this.dragging = null;
                        objData.element.style.cursor = 'move';
                        objData.velocityY = 0; // Reset velocity when dropped
                        
                        // Reset z-index based on position
                        this.updateZOrder();
                        
                        document.removeEventListener('mousemove', onMouseMove);
                        document.removeEventListener('mouseup', onMouseUp);
                    };
                    
                    document.addEventListener('mousemove', onMouseMove);
                    document.addEventListener('mouseup', onMouseUp);
                });
            }
            
            updateZOrder() {
                // Objects lower on screen appear in front
                const sorted = [...this.objects].sort((a, b) => a.y - b.y);
                sorted.forEach((obj, index) => {
                    obj.element.style.zIndex = 20 + index;
                });
            }
            
            checkCollisions(objData) {
                const maxY = this.workAreaHeight - objData.height;
                
                // Check collision with other objects
                for (let other of this.objects) {
                    if (other === objData) continue;
                    
                    // Check if objects overlap horizontally
                    const horizontalOverlap = (objData.x < other.x + other.width) && 
                                            (objData.x + objData.width > other.x);
                    
                    if (horizontalOverlap) {
                        // Check if this object is falling onto the other
                        const thisBottom = objData.y + objData.height;
                        const otherTop = other.y;
                        
                        if (thisBottom >= otherTop && objData.y < other.y) {
                            // Collision detected - place on top of other object
                            return other.y - objData.height;
                        }
                    }
                }
                
                // No collision, return ground level
                return maxY;
            }
            
            applyPhysics() {
                for (let objData of this.objects) {
                    if (objData.isDragging) {
                        objData.velocityY = 0;
                        continue;
                    }
                    
                    const targetY = this.checkCollisions(objData);
                    
                    if (objData.y < targetY - 1) {
                        // Object is falling
                        objData.velocityY += this.gravity;
                        objData.y += objData.velocityY;
                        
                        // Check if we've hit the target
                        if (objData.y >= targetY) {
                            objData.y = targetY;
                            objData.velocityY = 0;
                        }
                        
                        this.updateObjectPosition(objData);
                    } else if (objData.y > targetY) {
                        // Snap to correct position if somehow below target
                        objData.y = targetY;
                        objData.velocityY = 0;
                        this.updateObjectPosition(objData);
                    }
                }
                
                this.updateZOrder();
            }
            
            startPhysics() {
                const loop = () => {
                    this.applyPhysics();
                    this.animationId = requestAnimationFrame(loop);
                };
                loop();
            }
            
            // Handle window resize
            handleResize() {
                this.tableHeight = window.innerHeight * 0.15;
                this.workAreaHeight = window.innerHeight * 0.85;
                
                // Reposition objects if they're now out of bounds
                for (let objData of this.objects) {
                    objData.y = Math.min(objData.y, this.workAreaHeight - objData.height);
                    this.updateObjectPosition(objData);
                }
            }
        }
        
        // Initialize the system when page loads
        let dragSystem;
        window.addEventListener('load', () => {
            dragSystem = new DragDropSystem();
        });
        
        // Handle window resize
        window.addEventListener('resize', () => {
            if (dragSystem) {
                dragSystem.handleResize();
            }
        });
        
        // Prevent context menu on right click
        document.addEventListener('contextmenu', (e) => e.preventDefault());
    </script>
</body>
</html>