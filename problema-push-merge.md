# Problema con git push y cómo lo resolví

## Contexto

Al trabajar en mi repositorio local, intenté subir cambios a una rama (`js-nueva-funcionalidad`) pero recibí el siguiente error:

```
error: failed to push some refs to 'https://github.com/mikelnavarro/pagina.es.git'
hint: Updates were rejected because the tip of your current branch is behind
hint: its remote counterpart. If you want to integrate the remote changes,
hint: use 'git pull' before pushing again.
```

Esto sucede cuando la rama remota tiene cambios que tu rama local no tiene.

---

## Cómo lo solucioné

1. **Intenté hacer un `git pull`** para traer los cambios remotos, pero apareció otro error:
   ```
   error: You have not concluded your merge (MERGE_HEAD exists).
   hint: Please, commit your changes before merging.
   fatal: Exiting because of unfinished merge.
   ```

   Esto significa que había una fusión (merge) pendiente que no había terminado.

2. **Resolví el merge pendiente**:
   - Usé `git status` para ver los archivos en conflicto.
   - Edité los archivos afectados y resolví los conflictos.
   - Usé `git add <archivo>` para marcar los archivos como resueltos.
   - Hice un commit:  
     `git commit -m "Resuelvo conflicto de merge"`

3. **Después** de resolver el merge y hacer el commit, pude ejecutar:
   ```
   git push origin js-nueva-funcionalidad
   ```
   ¡Y funcionó!

---

## Nota sobre los archivos pendientes

Durante este proceso, tenía un archivo llamado `xxx.txt` en mi repositorio local.  
Lo añadí con:
```
git add xxx.txt
git commit -m "Añadido xxx.txt"
```
Cuando hice el push, **se subieron todos los cambios pendientes** en mi rama local al repositorio remoto. Es decir, si tienes varios archivos añadidos y/o modificados y haces un push, se subirán todos los commits que no estén todavía en el remoto.

---

## Resumen de comandos útiles

```bash
git status
git add <archivo>
git commit -m "mensaje"
git pull origin <rama>
git push origin <rama>
```

---

**Lección aprendida:**  
Antes de hacer push, asegúrate de que no haya merges pendientes y que tu rama local esté actualizada respecto al remoto. Si tienes archivos locales que has añadido y committeado, el push los subirá todos juntos.
