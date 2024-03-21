def separarTramas(contenido):
    tramas = []
    trama_actual = ""
    carga_util = 0
    count = 0 # Sirve para contar la trama en la que estoy
    pos_sec_escape = []
    for i in range(0,len(contenido),2):

        byte = contenido[i:i+2]

        if byte != "7E":
            trama_actual = trama_actual + byte
        else:
            if i==0:
                trama_actual = trama_actual + byte
                continue
            if contenido[i-2:i] == "7D":
                carga_util += 1
                trama_actual = trama_actual + byte
                pos_sec_escape.append(count)
            else:
                tramas.append(trama_actual)
                count += 1
                trama_actual = "7E"

    tramas_sin_sec_escape = mostrar_sec_escape(tramas,pos_sec_escape)
    return tramas,carga_util,tramas_sin_sec_escape

def mostrar_sec_escape(tramas,posiciones):
    tramas_sin_sec_escape = []
    for i in posiciones:
        nueva_trama = quitar_sec_escape(tramas[i])
        rta = f"La trama {i} SIN secuencia de escape es: {nueva_trama}"
        tramas_sin_sec_escape.append(rta)
    return tramas_sin_sec_escape

def quitar_sec_escape(trama):
    nueva_trama = ""
    for i in range(0,len(trama),2):
        if trama[i:i+2] == "7D" and trama[i+2:i+4] == "7E":
            continue
        else:
            nueva_trama = nueva_trama + trama[i:i+2]
    return nueva_trama

def comprobarLongitudes(tramas):
    longitud_1 = []
    longitud_2 = []
    for trama_actual in tramas:
        #Los 2 bytes desp de la bandera los paso a decimal
        longitud_actual = int(trama_actual[2:6],16)
        longitud_1.append(longitud_actual) 

        #Longitud sin el campo bandera,checksum y longitud
        longitud_aux = len(trama_actual[6:len(trama_actual)-2])/2 #1 byte son 2 numeros hexadecimales
        longitud_2.append(longitud_aux)
    
    correctas = 0
    incorrectas = 0
    tramas_correctas = []
    tramas_incorrectas = []
    count = 0

    for i in range(len(longitud_1)):
        if longitud_1[i] == longitud_2[i]:
            correctas += 1
            tramas_correctas.append(tramas[i])
        else:
            incorrectas += 1
            tramas_incorrectas.append(f"Trama {count} tiene longitud incorrecta: {tramas[count]}")

        count += 1

    return correctas,incorrectas,tramas_correctas,tramas_incorrectas

def sumarBytes(cadena):
    sum = 0
    for i in range(0,len(cadena)-2,2):
        sum += (int(cadena[i:i+2],16))
    
    return sum

def verificar_checkSum(tramas,bool=False):

    check_sum_array = [] #Aca guardo el checksum de todas las tramas
    sum_array = []
    for trama_actual in tramas:

        checkSum_actual = trama_actual[len(trama_actual)-2:len(trama_actual)]
        check_sum_array.append(int(checkSum_actual,16))

        #suma de todos los bytes sin incluir el bit bandera y el campo longitud
        sum_array.append(sumarBytes(trama_actual[6:len(trama_actual)]))

    num_hex = int("0xFF",16) 
    correctos = 0
    incorrectos = 0
    count = 0
    if bool:
        all_incorrects_checksums = [] # Lo voy a mostrar solo para el ejercicio adicional
    for i in range(len(check_sum_array)):
        checkSum = num_hex - (sum_array[i] & num_hex) #Formula del trabajo practico
        if checkSum == check_sum_array[i]: 
            correctos += 1
        else:
            incorrectos += 1
            if bool:
                all_incorrects_checksums.append(f"Trama {count} tiene checksum incorrecto: {tramas[count]}")
        count += 1

    if bool:
        return all_incorrects_checksums
    else:
        return correctos,incorrectos


    

archivo = open("Tramas_802-15-4.log","r")
contenido = archivo.read()

#Guarda las tramas , la cantidad de tramas con carga util y esa trama sin la carga util
aux = separarTramas(contenido) 

tramas = aux[0] 
tramas_sin_sec_escape = aux[2] 


respuestas = comprobarLongitudes(tramas) #Ejercicio 2
# Lo uso despues para calcular los Checksums de las tramas correctas
tramas_correctas = respuestas[2] 

# Vector de String mostrando las tramas incorrectas
tramas_incorrectas = respuestas[3] 

# Ejercicio 3, en este caso solo se calcula el checksum para las tramas de longitud correctas
respuestas_con_checksum = verificar_checkSum(tramas_correctas) 

# Para el TOTAL de tramas, me fijo cual tiene checksum incorrecto y los muestro
tramas_checksum_incorrecto = verificar_checkSum(tramas,True) # Vector de Strings


while True:
    print("1. Mostrar total de tramas")
    print("2. Mostrar tramas con longitud correcta e incorrecta")
    print("3. Para las tramas de longitud correcta, mostrar la cantidad que tienen Checksum correcto e incorrecto")
    print("4. Mostrar número de tramas que usan secuencia de escape")
    print("5. Número de linea y trama quitando la secuencia de escape")
    print("6. Mostrar tramas con longitud incorrecta y su número de trama")
    print("7. Mostrar TODAS las tramas con Checksum incorrecto")
    print("8. Salir")

    opcion_elegida = input("Ingrese la opción a mostrar (Solo el número): ")

    if opcion_elegida == "1":
        print(f"Numero total de tramas: {len(tramas)}")
    elif opcion_elegida == "2":
        print(f"Cantidad de longitudes correctas: {respuestas[0]}")
        print(f"Cantidad de longitudes incorrectas: {respuestas[1]}")
    elif opcion_elegida == "3":
        print(f"Tramas de longitud correcta con checksum correcto: {respuestas_con_checksum[0]}")
        print(f"Tramas de longitud correcta con checksum incorrecto: {respuestas_con_checksum[1]}")
    elif opcion_elegida == "4":
        print(f"Números de tramas que utilizan secuencia de escape: {aux[1]}")
    elif opcion_elegida == "5":
        for trama_actual in tramas_sin_sec_escape:
            print(trama_actual)
    elif opcion_elegida == "6":
        for trama_actual in tramas_incorrectas:
            print(trama_actual)
    elif opcion_elegida == "7":
        for trama_actual in tramas_checksum_incorrecto:
            print(trama_actual)
    elif opcion_elegida == "8":
        break
    else:
        print("Seleccione una opción correcta")
    print("-"*40)