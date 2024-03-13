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

    mostrar_sec_escape(tramas,pos_sec_escape)
    return tramas,carga_util

def mostrar_sec_escape(tramas,posiciones):
    for i in posiciones:
        nueva_trama = quitar_sec_escape(tramas[i])
        print(f"La trama {i} tiene secuencia de escape")
        print(f"La trama {i} SIN secuencia de escape es: {nueva_trama}")
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
    count = 0
    for i in range(len(longitud_1)):
        if longitud_1[i] == longitud_2[i]:
            correctas += 1
            tramas_correctas.append(tramas[i])
        else:
            incorrectas += 1
            print(f"Trama {count} tiene longitud incorrecta: {tramas[count]}")
        count += 1

    return correctas,incorrectas,tramas_correctas

def sumarBytes(cadena):
    sum = 0
    for i in range(0,len(cadena)-2,2):
        sum += (int(cadena[i:i+2],16))
    
    return sum

def verificar_checkSum(tramas):

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
    for i in range(len(check_sum_array)):
        checkSum = num_hex - (sum_array[i] & num_hex) #Formula del trabajo practico
        if checkSum == check_sum_array[i]: 
            correctos += 1
        else:
            incorrectos += 1
            print(f"Trama {count} tiene checksum incorrecto: {tramas[count]}")
        count += 1

    return correctos,incorrectos

archivo = open("Tramas_802-15-4.log","r")
contenido = archivo.read()
aux = separarTramas(contenido) #Guarda las tramas y la cantidad de tramas con carga util
tramas = aux[0]

respuestas = comprobarLongitudes(tramas)
tramas_correctas = respuestas[2]
respuestas_con_checksum = verificar_checkSum(tramas_correctas)


print(f"Numero total de tramas: {len(tramas)}")
print(f"Cantidad de longitudes correctas: {respuestas[0]}")
print(f"Cantidad de longitudes incorrectas: {respuestas[1]}")

print(f"Tramas de longitud correcta con checksum correcto: {respuestas_con_checksum[0]}")
print(f"Tramas de longitud correcta con checksum incorrecto: {respuestas_con_checksum[1]}")

print(f"Números de tramas que utilizan secuencia de escape: {aux[1]}")

"""#Falta corregir el el numero de trama para el checksum incorrecto,
recordar que se hace respecto a las tramas totales y el checksum respecto a las
tramas con longitud correcta"""