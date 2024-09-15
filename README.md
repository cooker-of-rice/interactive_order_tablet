1. **Načtení JSON**: Načítá se soubor `menu-data.json` pomocí `file_get_contents()` a dekóduje `json_decode()`. Ověřuje se existence a správnost dat.

2. **Vyhledávání**: Zpracování vstupu z vyhledávacího pole, ošetřeno funkcí `htmlspecialchars()` s výchozí prázdnou hodnotou.

3. **Kategorie**: Vykreslení kategorií z JSON, pokud existují.

4. **Položky menu**: Zobrazení položek, možnost filtrování dle vyhledávání.

5. **Výběr položky**: Zvolená položka se zobrazí v alertu pomocí JavaScriptu.

6. **Styly a obrázky**: Obrázky a styly jsou ve složkách `images/` a `styles/`.