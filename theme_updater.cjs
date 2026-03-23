const fs = require('fs');
const path = require('path');

const viewsDir = path.join(__dirname, 'resources', 'views');

function walkDir(dir) {
    let results = [];
    const list = fs.readdirSync(dir);
    list.forEach(file => {
        file = path.join(dir, file);
        const stat = fs.statSync(file);
        if (stat && stat.isDirectory()) {
            results = results.concat(walkDir(file));
        } else if (file.endsWith('.blade.php')) {
            results.push(file);
        }
    });
    return results;
}

const files = walkDir(viewsDir);

files.forEach(file => {
    let content = fs.readFileSync(file, 'utf8');
    
    // Backgrounds to pitch black / dark gray
    content = content.replace(/#09090b/g, '#000000');
    content = content.replace(/#18181b/g, '#0A0A0A');
    
    // Accents to Lavender (#C4B5FD is Tailwind violet-300, #A78BFA is violet-400)
    // Buttons
    content = content.replace(/bg-indigo-600/g, 'bg-[#C4B5FD] text-black font-semibold');
    content = content.replace(/hover:bg-indigo-700/g, 'hover:bg-[#A78BFA]');
    content = content.replace(/hover:bg-indigo-800/g, 'hover:bg-[#8B5CF6]');
    
    // Text
    content = content.replace(/text-indigo-600/g, 'text-[#C4B5FD]');
    content = content.replace(/text-indigo-500/g, 'text-[#C4B5FD]');
    content = content.replace(/text-indigo-400/g, 'text-[#C4B5FD]');
    content = content.replace(/text-indigo-300/g, 'text-[#E6E6FA]');
    
    // Borders
    content = content.replace(/border-indigo-500/g, 'border-[#C4B5FD]');
    content = content.replace(/ring-indigo-500/g, 'ring-[#C4B5FD]');
    
    // Background highlights (lavender tint)
    content = content.replace(/bg-indigo-500\/10/g, 'bg-[#C4B5FD]/10');
    content = content.replace(/bg-indigo-500\/20/g, 'bg-[#C4B5FD]/20');
    content = content.replace(/bg-indigo-50/g, 'bg-[#C4B5FD]/10');
    
    // Gradients in welcome
    content = content.replace(/from-indigo-100/g, 'from-[#C4B5FD]/20');
    content = content.replace(/from-indigo-600/g, 'from-[#C4B5FD]');
    content = content.replace(/to-purple-600/g, 'to-[#A78BFA]');
    content = content.replace(/from-indigo-400/g, 'from-[#C4B5FD]');
    content = content.replace(/to-purple-400/g, 'to-[#E6E6FA]');
    
    // Fix any doubled text-black font-semibold instances
    content = content.replace(/text-black font-semibold text-black font-semibold/g, 'text-black font-semibold');
    content = content.replace(/text-white text-black/g, 'text-black');
    content = content.replace(/text-white bg-\[#C4B5FD\] text-black/g, 'bg-[#C4B5FD] text-black');

    fs.writeFileSync(file, content, 'utf8');
});

console.log('Theme updated to Lavender and Black successfully!');
